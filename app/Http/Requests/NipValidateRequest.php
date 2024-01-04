<?php

namespace App\Http\Requests;

use App\Rules\CeidgNip;
use App\Rules\Pesel;
use Illuminate\Foundation\Http\FormRequest;

class NipValidateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nip' => ['numeric', 'required', new CeidgNip()],
            'pesel' => ['numeric', 'required', new Pesel()],
            'street' => 'required|string',
            'city' => 'required|string',
            'postcode' => 'required|string',
            'house_number' => 'required',
        ];
    }
}
