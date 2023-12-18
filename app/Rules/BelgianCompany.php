<?php

namespace App\Rules;

use App\Models\BelgianCompany as BelgianCompanyModel;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BelgianCompany implements ValidationRule
{
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $value = 'BE' . $value;
        /** @var Builder $existingCompany */
        $existingCompany = BelgianCompanyModel::where('identifier', $value);

        if (!$existingCompany->exists()) {
            $authKey = config('limosa.belgian_ceidg_id');
            $authToken = config('limosa.belgian_ceidg_token');

            if (empty($authKey) || empty($authToken)) {
                throw new \Exception('The config value for belgian nip is not set');
            }

            $response = Http::withHeaders(['API_ID' => $authKey, 'API_KEY' => $authToken])
                ->get("https://api.data.be/2.0/companies/" . $value. "/info");

            if ($response->ok()) {
                BelgianCompanyModel::create(
                    [
                        'identifier' => $response->collect()->get('identifier'),
                        'payload' => $response->body()
                    ]
                );
            } else {
                if($response->noContent()) {
                    $fail('The Belgian company was not found');
                }
                Log::channel('generation')->info($response->body());
                $fail('Undefined error fetching belgian company data');
            }
        }
    }
}
