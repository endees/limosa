<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'street' => 'required|string',
            'customer_email' => 'required|email',
            'city' => 'required|string',
            'postcode' => 'required|string',
            'business_name' => 'required|string',
            'nip' => 'required|numeric',
            'pesel' => 'required|numeric|digits:11',
        ];
    }
}
