<?php

namespace App\Http\Requests;

use App\Rules\DataBECheck;
use App\Rules\BelgianCompany;
use Illuminate\Foundation\Http\FormRequest;

class BelgianCompanyValidateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'belgian_nip' => 'numeric|required',
            'belgian_company_telephone' => 'nullable|numeric',
            'belgian_company_email' => 'nullable|email',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
    }
}
