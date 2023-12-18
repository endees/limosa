<?php

namespace App\Http\Requests;

use App\Rules\BelgianCompany;
use Illuminate\Foundation\Http\FormRequest;

class BelgianCompanyValidateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'belgian_nip' => ['numeric', 'required', new BelgianCompany()],
        ];
    }
}
