<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataFormRequest;
use App\Jobs\ProcessAccountCreation;
use Illuminate\Routing\Controller as BaseController;

class LimosaController extends BaseController
{
    protected array $parameters;

    public function register(DataFormRequest $request)
    {
        $formData = $request->all();
        ProcessAccountCreation::dispatch($formData);
        return view('success', []);
    }
}
