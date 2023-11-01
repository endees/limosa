<?php

namespace App\Http\Controllers;

use App\Models\Registrar;
use Illuminate\Routing\Controller as BaseController;

class LimosaController extends BaseController
{
    public function __construct(private readonly Registrar $registrar)
    {
    }

    public function register()
    {
        $data = $this->registrar->register();
        return view('success', $data);
    }
}
