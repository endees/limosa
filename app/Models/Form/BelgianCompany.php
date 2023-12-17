<?php

namespace App\Models\Form;

use App\Models\BelgianCompany as BelgianCompanyModel;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class BelgianCompany
{
    public function getBelgianCompanyData(string $belgianVatNumber): ?Collection
    {
        /** @var Builder $existingCompany */
        $existingCompany = BelgianCompanyModel::where('identifier', $belgianVatNumber);

        if (!$existingCompany->exists()) {
            $authKey = config('belgian.ceidg_key');
            $authToken = config('belgian.ceidg_token');

            $response = Http::withHeader('API_ID', $authKey)
                ->withHeader('API_KEY', $authToken)
                ->get("https://api.data.be/2.0/companies/" . $belgianVatNumber. "/info");

            if ($response->ok()) {
                BelgianCompanyModel::create(
                    [
                        'identifier' => $response->collect()->get('identifier'),
                        'payload' => $response
                    ]
                );
                return $response->collect();
            }
            return null;
        } else {
            return $existingCompany->get('payload')->collect();
        }
    }
}
