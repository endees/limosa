<?php

namespace App\Jobs;

use App\Models\FakeMail\TenMinuteMailApi;
use App\Models\Registrar;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class ProcessLimosaCreation implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Registrar $registrar;
    private TenMinuteMailApi $mailApi;
    private Log $logger;

    public function __construct(
        private readonly array $formData
    ) {
        $this->registrar = App::make(Registrar::class);
        $this->mailApi = App::make(TenMinuteMailApi::class);
    }

    public function handle(): void
    {
        $emailData = $this->mailApi->register('daniel');
        Log::info('Start registering a new client with email: ' . $emailData['address']);
        $allData = array_merge($emailData, $this->formData);
        $this->registrar->register($allData);
        Log::info('End registering the new client with email: ' . $emailData['address']);
    }
}
