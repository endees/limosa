<?php

namespace App\Models\FakeMail;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TenMinuteMailApi implements MailApiInterface
{
    private $baseUrl = 'https://api.mail.tm/';

    private function getDomains(): Collection
    {
        $rawResponse = Http::get($this->baseUrl . 'domains')->collect();
        return $rawResponse->only('hydra:member')->collapse()->map(
            function (array $item) {
                if (isset($item['domain'])) {
                    return $item['domain'];
                }
            }
        );
    }

    private function pickAddress(array $createdAddress): array
    {
        $response = Http::timeout(180)->post($this->baseUrl . 'accounts', $createdAddress)->collect();

        if ($response->get('isDisabled') !== false && $response->get('isDeleted') !== false) {
            throw new \Exception('Account disabled or deleted');
        }

        $tokenResponse = Http::withHeader('accept', 'application/json')
            ->timeout(180)
            ->withBody(json_encode($createdAddress))
            ->post($this->baseUrl . 'token')
            ->collect();

        if ($tokenResponse->has('token')) {
            $createdAddress['token'] = $tokenResponse->get('token');
        } else {
            throw new \Exception('No token received from the email api: ' . "\n" . $tokenResponse->toJson());
        }

        return $createdAddress;
    }

    public function register(): array
    {
        $availableDomains = $this->getDomains();
        $createdAddress = [
            'address' => Str::random(10) . '@' . $availableDomains->random(),
            'password' => Str::random(8)
        ];
        $createdData = $this->pickAddress($createdAddress);
        return $createdData;
    }

    public function getMessages(string $token)
    {
        $tokenResponse = Http::withHeader('Bearer', $token)
            ->timeout(180)->get($this->baseUrl . 'messages')->collect();
        return $tokenResponse;
    }
}
