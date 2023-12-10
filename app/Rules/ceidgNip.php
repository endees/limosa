<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class ceidgNip implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $authToken = config('limosa.ceidg_token');
        $response = Http::withHeader('Authorization', 'Bearer ' . $authToken)
            ->get("https://dane.biznes.gov.pl/api/ceidg/v2/firmy?nip=" . $value);

        if ($response->noContent()) {
            $fail('The NIP number has not been found');
        }
        if ($response->badRequest()) {
            $fail($response->collect()->get('message'));
        }
    }
}
