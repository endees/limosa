<?php

namespace App\Jobs;

use App\Models\FakeMail\EmailAdapter;
use App\Models\DriverHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

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
        Log::info('End limosa generation');
    }
}
