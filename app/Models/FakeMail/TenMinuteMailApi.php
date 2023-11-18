<?php

namespace App\Models\FakeMail;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TenMinuteMailApi
{
    private $baseUrl = 'https://api.mail.gw/';

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

    private function pickAddress($name, $domains): array
    {
        $createdAddress = [
            'address' => Str::random() . '@' . $domains->random(),
            'password' => Str::random()
        ];
        $response = Http::post($this->baseUrl . 'accounts', $createdAddress)->collect();

        if ($response->get('isDisabled') !== false && $response->get('isDeleted') !== false) {
            throw new \Exception('Account disabled or deleted');
        }

        return $createdAddress;
    }

    public function register($name): array
    {
        $availableDomains = $this->getDomains();
        $createdData = $this->pickAddress($name, $availableDomains);
        return $createdData;
    }
}
