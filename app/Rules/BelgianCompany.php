<?php

namespace App\Rules;

use App\Models\BelgianCompany as BelgianCompanyModel;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Translation\PotentiallyTranslatedString;

class BelgianCompany implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $response = Http::post(
            "https://ec.europa.eu/taxation_customs/vies/rest-api/check-vat-number",
            [
                "countryCode" => "BE",
                "vatNumber" => $value
            ]
        );

        BelgianCompanyModel::firstOrCreate(
            [
                'identifier' => $value,
                'business_name' => $response->collect()->get('name')
            ]
        );
    }
}
