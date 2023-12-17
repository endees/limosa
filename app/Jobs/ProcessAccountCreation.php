<?php

namespace App\Jobs;

use App\Models\FakeMail\EmailAdapter;
use App\Models\DriverHandler;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

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
            Log::channel('registration')->info('Start registering a new client with data: ' . json_encode($emailData));
            $allData = array_merge($emailData, $this->formData);
            $this->driverHandler->register($allData);
            ActivateAccount::dispatch($allData)->delay(60);
        }
    }
}
