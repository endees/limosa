<?php

namespace App\Models\Validator;

use Illuminate\Support\Facades\Http;

class ViesChecker
{
    public function check($value)
    {
        $response = Http::post(
            "https://ec.europa.eu/taxation_customs/vies/rest-api/check-vat-number",
            [
                "countryCode" => "BE",
                "vatNumber" => $value
            ]
        );
        return $response->collect()->get('valid');
    }
}
