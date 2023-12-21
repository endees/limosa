<?php

return [

    'mail_api' => \App\Models\FakeMail\GuerillaMailApi::class,
    'ceidg_token' => env('CEIDG_KEY'),
    'belgian_ceidg_id' => env('BELGIAN_CEIDG_ID'),
    'belgian_ceidg_token' => env('BELGIAN_CEIDG_KEY'),
    'limosa_username' => 'danielmaterka',
    'limosa_password' => 'm@tTorp3da',
    'registration_data_recipients' => [
        'radek@meso.works'
    ],
    'admin_recipients' => [
        'daniel.materka@gmail.com'
    ]
];
