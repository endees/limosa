<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataFormRequest extends FormRequest
{
    public function rules(BelgianCompanyValidateRequest $belgianCompanyStepRules, DataInitRequest $dataInitRequestRules, NipValidateRequest $nipValidateRequest)
    {
        return array_merge($belgianCompanyStepRules->rules(), $dataInitRequestRules->rules(), $nipValidateRequest->rules());
    }
}
