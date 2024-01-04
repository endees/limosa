<?php

namespace App\Http\Requests;

use App\Rules\DataBECheck;
use App\Rules\ViesValidation;
use Illuminate\Foundation\Http\FormRequest;

class BelgianCompanyValidateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'belgian_nip' => ['numeric', 'required'],
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ];
    }
}
