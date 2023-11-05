<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'full_name' => 'string',
            'date_of_birth' => 'string',
            'nationality' => 'string',
            'business_name' => 'string',
            'business_address' => 'string'
        ];
    }
}
