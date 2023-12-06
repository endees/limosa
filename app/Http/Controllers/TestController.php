<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataFormRequest;

use App\Jobs\ProcessLimosaGeneration;
use App\Models\FakeMail\TenMinuteMailApi;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class TestController extends BaseController
{
    protected array $parameters;

    public function __construct()
    {
    }

    public function create(DataFormRequest $request)
    {
        $json = '{
                  "address":"ydroqtwd@guerrillamailblock.com",
                  "username":"ydroqtwd",
                  "password":"UmRXBgA1@",
                  "lastname": "Klepuszewski",
                  "firstname": "Tomasz",
                  "pesel":"80052724677",
                  "date_of_birth":"05/27/1980",
                  "street": "Rapackiego" ,
                  "house_number":"2",
                  "flat_number":"1",
                  "postcode": "71-467",
                  "city": "Szczecin",
                  "nip": "8511459011",
                  "token":"q2sep7rmdja8jdmiv8ol651hi3",
                  "email_timestamp":1700952647,
                  "alias":"te0gwl+33jndmhuw3t2w"
                  "business_name":"Knauf Montaj SPRL"
                  "date_start":"05/27/2023"
                  "date_end":"12/27/2023"
                  }';
        $data = json_decode($json, true);

        ProcessLimosaGeneration::dispatch($data);
        return view('success', []);
    }
}
