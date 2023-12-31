<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class ViesValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $response = Http::post(
            "https://ec.europa.eu/taxation_customs/vies/rest-api//check-vat-number",
            [
                "countryCode" => "BE",
                "vatNumber" => $value
            ]
        );

        if ($response->noContent()) {
            $fail('The VAT number has not been found');
        }

        if ($response->badRequest()) {
            $fail($response->collect()->get('errorWrappers.message'));
        }

        if ($response->collect()->get('valid') !== true) {
            $fail('The VAT number has not been found');
        }
    }
}
