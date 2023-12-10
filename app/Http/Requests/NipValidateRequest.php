<?php

namespace App\Http\Requests;

use App\Rules\ceidgNip;
use Illuminate\Foundation\Http\FormRequest;

class NipValidateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'firstname' => 'string',
            'lastname' => 'string',
            'nip' => ['numeric', new ceidgNip()]
        ];
    }
}
