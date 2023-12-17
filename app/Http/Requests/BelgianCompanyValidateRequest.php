<?php

namespace App\Http\Requests;

use App\Rules\CeidgNip;
use App\Rules\Pesel;
use Illuminate\Foundation\Http\FormRequest;

class BelgianCompanyValidateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'belgian_nip' => 'required|numeric'
        ];
    }
}
