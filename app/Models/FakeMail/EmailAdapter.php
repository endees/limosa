<?php

namespace App\Models\FakeMail;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

class EmailAdapter implements MailApiInterface
{
    public function __construct(
    ) {
        $mailApiClass = config('limosa.mail_api');
        $this->mailApi = App::make($mailApiClass);
    }

    public function register(): array {
        return $this->mailApi->register();
    }

    public function getMessages($token): Collection {
        return $this->mailApi->getMessages($token);
    }
}
