<?php

namespace App\Jobs;

use App\Models\DriverHandler;
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

    private DriverHandler $driverHandler;
    private EmailAdapter $mailApi;
    private Log $logger;
    public $tries = 6;

    public function __construct(
        private array $formData
    ) {
        $this->driverHandler = App::make(DriverHandler::class);
        $this->mailApi = App::make(EmailAdapter::class);
    }

    public function handle(): void
    {
        Log::channel('activation')->info('Check for new messages client with email: ' . $this->formData['address']);

        $messages = $this->mailApi->getMessages($this->formData['token']);
        $filteredMessages = collect($messages->get('list'))->filter(function($value) {
            if ($value['mail_from'] == "limosa-usermanagement@smals-mvm.be") {
                return true;
            }
            return false;
        });

        if ($filteredMessages->isEmpty()) {
            Log::channel('activation')->info('No message received from limosa-usermanagement');
            $this->release(360);
        }
        Log::channel('activation')->info($filteredMessages);

        $email = $filteredMessages->first();

        $message = $this->mailApi->getMessage(
            $this->formData['token'],
            $email['mail_id']
        );

        $messageBody = $message->get('mail_body');
        Log::channel('activation')->info('First email: ' . $messageBody);

        if ($messageBody) {
            Log::channel('activation')->info('First email body: ' . $messageBody);
            if (preg_match( '@.*could not be registered since you already have a registered account.*"@', $messageBody)) {
                // todo inform the customer that the account cannot be created
                $this->fail('The account is already created on limosa.be');
                $this->delete();
            }

            preg_match( '@.*Thank you for creating an account.*href="(.*)".*@', $messageBody, $url);
            if (isset($url[1])) {
                $this->formData['activation_link'] = $url[1];
                Log::channel('activation')->info('End registering the new client with email: ' . $this->formData['address']);
                $this->driverHandler->activateAccount($this->formData);
                ProcessLimosaGeneration::dispatch($this->formData);
            }
        } else {
            $this->fail('There is no email body');
        }
    }
    public function backoff()
    {
        return [300, 300, 300, 600, 600];
    }
}
