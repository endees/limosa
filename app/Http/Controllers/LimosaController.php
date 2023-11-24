<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataFormRequest;
use App\Jobs\ProcessLimosaCreation;
use Illuminate\Routing\Controller as BaseController;

class LimosaController extends BaseController
{
    protected array $parameters;

    public function register(DataFormRequest $request)
    {
        $formData = $request->all();
        ProcessLimosaCreation::dispatch($formData);
        return view('success', []);
    }
}