<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkSiteValidateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nip_place_of_work' => 'array|max:5|nullable',
            'nip_place_of_work.*' => 'numeric|digits:10',
            'site_address' => 'array|max:5|nullable',
            'site_address.*.name' => 'required_with:site_address|string|max:25',
            'site_address.*.street' => 'required_with:site_address|string|max:25',
            'site_address.*.house_number' => 'required_with:site_address|digits|max:5',
            'site_address.*.apartment_number' => 'digits|max:5',
            'site_address.*.post_code' => 'required_with:site_address|max:5'
        ];
    }
}
