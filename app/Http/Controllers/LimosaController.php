<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataFormRequest;
use App\Models\Registrar;
use Illuminate\Routing\Controller as BaseController;

class LimosaController extends BaseController
{
    protected array $parameters;

    public function __construct(
        private readonly Registrar $registrar
    ) {
    }

    public function register(DataFormRequest $request)
    {
        $formData = $request->all();
        $formData = array_merge($formData, [
            'password' => 'm@tTorp3da'
        ]);

        $data = $this->registrar->register($formData);
        return view('success', $data);
    }
}
