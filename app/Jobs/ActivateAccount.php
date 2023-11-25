<?php

namespace App\Jobs;

use App\Models\FakeMail\EmailAdapter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class ActivateAccount implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private EmailAdapter $mailApi;
    private Log $logger;
    public $tries = 20;
    public $maxExceptions = 10;

    public function __construct(
        private readonly array $formData
    ) {
        //todo launches every second
        $this->delay = 60;
        $this->mailApi = App::make(EmailAdapter::class);
    }

    public function handle(): void
    {
        Log::info('Check for new messages client with email: ' . $this->formData['address']);
        $messages = $this->mailApi->getMessages($this->formData['token']);
        Log::info($messages->toJson());

        $filteredMessages = collect($messages->get('list'))->filter(function($value) {
            if ($value->mail_from == "limosa-usermanagement@smals-mvm.be") {
                return true;
            }
        });

        Log::info('Filtered messages: ' . $filteredMessages);
        if ($filteredMessages->isEmpty()) {
          $this->release(60);
        }

        $mailId = $filteredMessages->first()->mail_id;

        $message = $this->mailApi->getMessage($this->formData['token'], $mailId);

        Log::info('MailId: ' . $mailId);
        Log::info($message);
        Log::info('End registering the new client with email: ' . $this->formData['address']);
    }
}
