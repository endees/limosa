<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataFormRequest;
use App\Jobs\ProcessAccountCreation;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class LimosaController extends BaseController
{
    protected array $parameters;

    public function register(DataFormRequest $request)
    {
        $formData = $request->all();
        Log::info('Start registering ip address ' . $request->ip());
        ProcessAccountCreation::dispatch($formData);
        return view('success', []);
    }
}
