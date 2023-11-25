<?php

namespace App\Models\FakeMail;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GuerillaMailApi implements MailApiInterface
{
    private $baseUrl = 'http://api.guerrillamail.com/ajax.php';

    public function register(): array
    {
        $response = Http::get($this->baseUrl , 'f=get_email_address');
        $rawResponseData = $response->collect();
        $createdAddress = [
            'address' => $rawResponseData->get('email_addr'),
            'password' => Str::random(8),
            'token' => $rawResponseData->get('sid_token'),
            'email_timestamp' => $rawResponseData->get('email_timestamp'),
            'alias' => $rawResponseData->get('alias')
        ];
        return $createdAddress;
    }

    public function getMessages(string $token): Collection
    {
        $rawResponse = Http::withCookies(['PHPSESSID' => $token], '.guerrillamail.com')
            ->get($this->baseUrl , 'f=get_email_list&offset=0')
            ->collect();
        return $rawResponse;
    }

    public function getMessage(string $token, $mailId): Collection
    {
        $response = Http::withCookies(['PHPSESSID' => $token], '.guerrillamail.com')
            ->get($this->baseUrl , 'f=fetch_email&email_id='. $mailId)
            ->collect();
        return $response;
    }

    public function forgetEmail(string $email)
    {
        $rawResponse = Http::get($this->baseUrl , 'f=forget_me&email='. $email)->collect();
    }
}
