<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkSiteValidateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nip_place_of_work.*' => 'numeric',
//            'belgian_company_telephone' => 'nullable|numeric',
//            'belgian_company_email' => 'nullable|email',
//            'site_name' => '',
//            'site_street' => '',
//            'site_house_number' => '',
//            'site_apartment_number' => 'nullable',
//            'site_post_code' => ''
        ];
    }
}
