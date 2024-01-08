<?php

namespace App\Http\Requests;

use App\Rules\DataBECheck;
use App\Rules\ViesValidation;
use Illuminate\Foundation\Http\FormRequest;

class BelgianCompanyValidateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'belgian_nip' => ['numeric', 'required'],
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'without_declaring_site' => 'required|string',
            'site_name' => 'required_if:without_declaring_site,false',
            'site_street' => 'required_without:without_declaring_site,false',
            'site_house_number' => 'required_without:without_declaring_site,false',
            'site_apartment_number' => 'nullable',
            'site_post_code' => 'required_without:without_declaring_site,false'
        ];
    }
}
