<?php

namespace App\Rules;

use App\Models\BelgianCompany as BelgianCompanyModel;
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
            "https://ec.europa.eu/taxation_customs/vies/rest-api/check-vat-number",
            [
                "countryCode" => "BE",
                "vatNumber" => $value
            ]
        );

        if ($response->ok()) {
            if ($response->collect()->get('valid') !== true) {
                $fail('The VAT number has not been found');
            }
            $belgianCompany = BelgianCompanyModel::firstOrCreate(
                [
                    'identifier' => $response->collect()->get('vatNumber'),
                    'business_name' => $response->collect()->get('name')
                ]
            );
        } else {
            if ($response->badRequest()) {
                $fail($response->collect()->get('errorWrappers.message'));
            }
            $fail('The VAT number has not been found');
        }
    }
}
