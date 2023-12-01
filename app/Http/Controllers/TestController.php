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
        $json = '{"address":"ydroqtwd@guerrillamailblock.com", "username":"ydroqtwd", "password":"UmRXBgA1@","lastname": "Materka", "firstname": "Daniel",  "pesel":"88061715697", "date_of_birth":"06/17/1988", "street": "limby" , "house_number":"12", "flat_number":"12","postcode": "71-784", "city": "Szczecin", "nip": "8512974519", "token":"q2sep7rmdja8jdmiv8ol651hi3","email_timestamp":1700952647,"alias":"te0gwl+33jndmhuw3t2w"}';
        $data = json_decode($json, true);

        ProcessLimosaGeneration::dispatch($data);
        return view('success', []);
    }
}
