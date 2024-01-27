<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataFormRequest extends FormRequest
{
    public function rules(
        BelgianCompanyValidateRequest $belgianCompanyStepRules,
        DataInitRequest $dataInitRequestRules,
        NipValidateRequest $nipValidateRequest,
        WorkSiteValidateRequest $siteValidateRequest
    ) {
        return array_merge(
            [
                'limosalanguage' => 'required|array|min:1',
                'dataagreement' => 'array',
                'dataagreement.rodo' => 'required'
            ],
            $belgianCompanyStepRules->rules(),
            $dataInitRequestRules->rules(),
            $nipValidateRequest->rules(),
            $siteValidateRequest->rules()
        );
    }
}
