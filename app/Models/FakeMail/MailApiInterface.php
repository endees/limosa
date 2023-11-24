<?php

namespace App\Models\FakeMail;

use Illuminate\Support\Collection;

interface MailApiInterface
{
    public function register(): array;

    public function getMessages(string $token): Collection;
}
