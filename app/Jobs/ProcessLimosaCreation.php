<?php

namespace App\Jobs;

use App\Models\FakeMail\EmailAdapter;
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
    private EmailAdapter $mailApi;
    private Log $logger;

    public function __construct(
        private readonly array $formData
    ) {
        $this->registrar = App::make(Registrar::class);
        $this->mailApi = App::make(EmailAdapter::class);
    }

    public function handle(): void
    {
        $emailData = $this->mailApi->register();
        Log::info('Start registering a new client with data: ' . json_encode($emailData));
        $allData = array_merge($emailData, $this->formData);

        $this->registrar->register($allData);
        $messages = $this->mailApi->getMessages($allData['token']);
        Log::info($messages->toJson());
        Log::info('End registering the new client with email: ' . $emailData['address']);
    }
}