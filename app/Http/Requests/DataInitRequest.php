<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataInitRequest extends FormRequest
{
    public function rules()
    {
        return [
            'firstname' => 'required|string|max:24',
            'lastname' => 'required|string|max:24',
            'customer_email' => 'email|required',
            'customer_telephone' => 'numeric|required',
            'g-recaptcha-response' => 'required'
        ];
    }
}
