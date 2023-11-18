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

    private function pickAddress($name, $domains) {
        $name = Str::random();
        $password = Str::random();
        $domain = $domains->random();
        $rawResponse = Http::post($this->baseUrl . 'accounts', [
            'address' => $name . '@' . $domain,
            'password' => $password
        ]);
        return $rawResponse;
    }

    public function register($name) {
        $availableDomains = $this->getDomains();
        return $this->pickAddress($name, $availableDomains);
    }
}
