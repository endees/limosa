<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkSiteValidateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'belgian_nip' => 'numeric|required',
            'belgian_company_telephone' => 'nullable|numeric',
            'belgian_company_email' => 'nullable|email',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'without_declaring_site' => 'string',
            'site_name' => 'required_if:without_declaring_site,false',
            'site_street' => 'required_if:without_declaring_site,false',
            'site_house_number' => 'required_if:without_declaring_site,false',
            'site_apartment_number' => 'nullable',
            'site_post_code' => 'required_if:without_declaring_site,false'
        ];
    }
}
