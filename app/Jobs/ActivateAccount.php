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
    public $tries = 5;

    public function __construct(
        private array $formData
    ) {
        $this->mailApi = App::make(EmailAdapter::class);
    }

    public function handle(): void
    {
        Log::info('Check for new messages client with email: ' . $this->formData['address']);

        $messages = $this->mailApi->getMessages($this->formData['token']);
        $filteredMessages = collect($messages->get('list'))->filter(function($value) {
            if ($value['mail_from'] == "limosa-usermanagement@smals-mvm.be") {
                return true;
            }
            return false;
        });

        Log::info($filteredMessages);

        if ($filteredMessages->isEmpty()) {
            Log::info('No message received from limosa-usermanagement');
            $this->release(now()->addMinutes(2));
        }

        $email = $filteredMessages->first();

        $message = $this->mailApi->getMessage($this->formData['token'], $email['mail_id']);
        $messageBody = $message->get('mail_body');
        Log::info('First email: ' . $messageBody);

        if ($messageBody) {
            Log::info('First email body: ' . $messageBody);
            $matches = preg_match( '@href="(.*)"@', $messageBody);
            if (isset($matches[1])) {
                $this->formData['activation_link'] = $matches[1];
                Log::info('End registering the new client with email: ' . $this->formData['address']);

                ProcessLimosaGeneration::dispatch($this->formData);
            }
        } else {
            $this->fail('There is no email body');
        }
    }
}
