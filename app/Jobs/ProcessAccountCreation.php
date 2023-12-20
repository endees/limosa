<?php

namespace App\Jobs;

use App\Mail\JobFailed;
use App\Models\FakeMail\EmailAdapter;
use App\Models\DriverHandler;
use Carbon\Carbon;
use http\Exception\InvalidArgumentException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\ManuallyFailedException;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessAccountCreation implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private DriverHandler $driverHandler;
    private EmailAdapter $mailApi;
    private Log $logger;

    public function __construct(
        private array $formData
    ) {
        $this->driverHandler = App::make(DriverHandler::class);
        $this->mailApi = App::make(EmailAdapter::class);
    }

    public function handle(): void
    {
        $this->formData['jobUUID'] = $this->job->getJobId();
        if (!empty($this->formData['username']) && !empty($this->formData['password'])) {
            Log::channel('registration')->info('Generating limosa with the credentials: ' . json_encode($this->formData['customer_email']));
            ProcessLimosaGeneration::dispatch($this->formData);
        } else {
            $emailData = $this->mailApi->register();
            $username = explode('@', $emailData['address'])[0];
            $emailData['username'] = $username;
            $allData = array_merge($emailData, $this->formData);
            Log::channel('registration')->info('Start registering a new client with data: ' . json_encode($allData));
            $this->driverHandler->register($allData);
            ActivateAccount::dispatch($allData)->delay(60);
        }
    }
    public function fail($exception = null)
    {
        $jobFailedMail = new JobFailed($exception, $this->job->getJobId());
        Mail::to(config('limosa.admin_recipients'))->send($jobFailedMail);
        if (is_string($exception)) {
            $exception = new ManuallyFailedException($exception);
        }

        if ($exception instanceof Throwable || is_null($exception)) {
            if ($this->job) {
                return $this->job->fail($exception);
            }
        } else {
            throw new InvalidArgumentException('The fail method requires a string or an instance of Throwable.');
        }
    }
}
