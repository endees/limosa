<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

        $responseCollection = Http::withHeader('Authorization', 'Bearer ' . $authToken)
            ->get("https://dane.biznes.gov.pl/api/ceidg/v2/firmy?nip=" . $value);
        //        TODO
        if (true !== false) {
            $fail('The company was not found.');
        }
    }
}
