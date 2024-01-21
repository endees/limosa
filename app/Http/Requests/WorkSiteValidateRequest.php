<?php

namespace App\Http\Requests;

use App\Models\Postcodes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class WorkSiteValidateRequest extends FormRequest
{
    public function rules()
    {
        /**
         * @var Postcodes $postcodes
         */
        $postcodes = App::make(Postcodes::class);
        return [
            'nip_place_of_work' => 'array|max:5|nullable',
            'nip_place_of_work.*' => 'numeric|digits:10',
            'site_address' => 'array|max:5|nullable',
            'site_address.*.name' => 'required_with:site_address|string|between:3,50',
            'site_address.*.street' => 'required_with:site_address|string|between:3,50',
            'site_address.*.house_number' => 'required_with:site_address|string|between:1,10',
            'site_address.*.apartment_number' => 'nullable|string|between:1,10',
            'site_address.*.postcode' => ['required_with:site_address|between:3,50', Rule::in($postcodes->getRawPostCodes())]
        ];
    }
}
