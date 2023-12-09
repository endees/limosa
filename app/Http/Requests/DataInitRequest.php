<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataInitRequest extends FormRequest
{
    public function rules()
    {
        return [
            'firstname' => 'string',
            'lastname' => 'string',
            'email' => 'string',
        ];
    }
}
