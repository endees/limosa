<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'firstname' => 'string',
            'lastname' => 'string',
            'date_of_birth' => 'string',
            'nationality' => 'string',
            'pesel' => 'string',
            'street' => 'string',
            'city' => 'string',
            'postcode' => 'string',
            'contract_name' => 'string',
            'business_address' => 'string'
        ];
    }
}
