<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataFormRequest;
use App\Http\Requests\DataInitRequest;
use App\Http\Requests\NipValidateRequest;
use App\Jobs\ProcessAccountCreation;
use App\Validation\NipValidator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class FormController extends BaseController
{
    protected array $parameters;

    public function register(DataFormRequest $request)
    {
        $formData = $request->all();
        Log::info('Start registering ip address ' . $request->ip());
        ProcessAccountCreation::dispatch($formData);
        return view('success', []);
    }

    public function init(DataInitRequest $request) {
        $formData = $request->all();
        // mail data
        return response()->json([
            "message" => "Success"
        ]);
    }

    public function company(NipValidateRequest $request)
    {
        $nip = $request->nip();

        $nipValidator = App::make(NipValidator::class);
        $nipValidator->validate($nip);

        return response()->json([
            "message" => "Success"
        ]);
    }
}
