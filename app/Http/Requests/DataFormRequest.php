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
            'house_number' => 'required',
            'postcode' => 'required|string',
            'belgian_nip' => 'required|numeric',
            'nip' => 'required|numeric',
            'pesel' => 'required|numeric|digits:11',
            'username' => 'max:36',
            'password' => 'max:36',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'limosalanguage' => 'required|min:1',
            'dataagreement' => 'required',
            'dataagreement.rodo' => 'required',
        ];
    }
}
