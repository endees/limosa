<?php

namespace App\Jobs;

use App\Mail\JobFailed;
use App\Mail\LimosaGenerated;
use App\Models\FakeMail\EmailAdapter;
use App\Models\DriverHandler;
use http\Exception\InvalidArgumentException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\ManuallyFailedException;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessLimosaGeneration implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private DriverHandler $driverHandler;
    private EmailAdapter $mailApi;
    private Log $logger;

    public function __construct(
        private readonly array $formData
    ) {
        $this->driverHandler = App::make(DriverHandler::class);
        $this->mailApi = App::make(EmailAdapter::class);
    }

    public function handle(): void
    {
        Log::info('Start generating a new limosa for: ' . json_encode($this->formData));
        $this->driverHandler->generateLimosa($this->formData);

        /** @var Filesystem $filesystem */
        $filesystem = App::make(Filesystem::class);
        $limosas = $filesystem->files('storage/limosas/');
        /** @var \SplFileInfo $limosa */
        $limosa = array_pop($limosas);
        $mailable = new LimosaGenerated($limosa->getPathname());
        Mail::to($this->formData['customer_email'])->send($mailable);
        Log::info('End limosa generation');
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
