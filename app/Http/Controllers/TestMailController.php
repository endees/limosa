<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataFormRequest;

use App\Models\FakeMail\TenMinuteMailApi;
use Illuminate\Routing\Controller as BaseController;

class TestMailController extends BaseController
{
    protected array $parameters;

    public function __construct(
        private readonly TenMinuteMailApi $mailApi
    ) {
    }

    public function create(DataFormRequest $request)
    {
        $formData = $request->all();
        $formData = array_merge($formData, [
            'password' => 'm@tTorp3da'
        ]);

        $mailData = $this->mailApi->register('testowy');
//        $mailData = array ( '@context' => '/contexts/Domain', '@id' => '/domains', '@type' => 'hydra:Collection', 'hydra:member' => array ( 0 => array ( '@id' => '/domains/651fc1f48650e155719906de', '@type' => 'Domain', 'id' => '651fc1f48650e155719906de', 'domain' => 'hexv.com', 'isActive' => true, 'createdAt' => '2023-10-06T00:00:00+00:00', 'updatedAt' => '2023-10-06T00:00:00+00:00', ), 1 => array ( '@id' => '/domains/651fc2088650e155719906e0', '@type' => 'Domain', 'id' => '651fc2088650e155719906e0', 'domain' => 'hoanghainam.com', 'isActive' => true, 'createdAt' => '2023-10-06T00:00:00+00:00', 'updatedAt' => '2023-10-06T00:00:00+00:00', ), 2 => array ( '@id' => '/domains/651fc2218650e155719906e2', '@type' => 'Domain', 'id' => '651fc2218650e155719906e2', 'domain' => 'inlith.com', 'isActive' => true, 'createdAt' => '2023-10-06T00:00:00+00:00', 'updatedAt' => '2023-10-06T00:00:00+00:00', ), 3 => array ( '@id' => '/domains/651fc25e8650e155719906e4', '@type' => 'Domain', 'id' => '651fc25e8650e155719906e4', 'domain' => 'kataskopoi.com', 'isActive' => true, 'createdAt' => '2023-10-06T00:00:00+00:00', 'updatedAt' => '2023-10-06T00:00:00+00:00', ), ), 'hydra:totalItems' => 4);
        var_dump($mailData);
        return view('mailResult', ['domains' => $mailData]);
    }
}
