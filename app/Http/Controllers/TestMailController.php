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

        $json = '{
            "list": [
        {
            "mail_id": "127318291",
            "mail_from": "limosa-usermanagement@smals-mvm.be",
            "mail_subject": "Belgian Social Security Portal | Limosa account registration",
            "mail_excerpt": "Dear Dagda Tead,Thank you for creating an account. Your username is orpnlwxg.Please click on the link below to activate your account: ",
            "mail_timestamp": "1700871435",
            "mail_read": "0",
            "mail_date": "00:17:15",
            "att": "0",
            "mail_size": "2785"
        },
        {
            "mail_from": "no-reply@guerrillamail.com",
            "mail_timestamp": 0,
            "mail_read": 0,
            "mail_date": "00:16:41",
            "reply_to": "",
            "mail_subject": "Welcome to Guerrilla Mail",
            "mail_excerpt": "Dear Random User,"
        }
    ]
}';
        $dec = json_decode($json);
        $test = collect(collect($dec)->get('list'))->filter(function($value) {
            if ($value->mail_from == "limosa-usermanagement@smals-mvm.be") {
                return true;
            }
        })->isEmpty();
        var_dump($test);
        exit();
    }
}
