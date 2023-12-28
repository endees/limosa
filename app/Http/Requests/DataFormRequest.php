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
            'customer_telephone' => 'numeric|required',
            'city' => 'required|string',
            'postcode' => 'required|string',
            'belgian_nip' => 'required|numeric',
            'nip' => 'required|numeric',
            'pesel' => 'required|numeric|digits:11',
            'username' => 'max:36',
            'password' => 'max:36',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:tomorrow',
            'dataprocessing' => 'required',
            'g-recaptcha-response' => 'required'
        ];
    }
}
