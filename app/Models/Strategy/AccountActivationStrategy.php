<?php

namespace App\Models\Strategy;

use App\Models\Strategy\Pages\Registration\ActivateAccount;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class AccountActivationStrategy
{
    protected $pageHandlersFirst = [];

    public function __construct(
        public readonly ActivateAccount $activateAccount,
    )
    {
    }

    public function execute(RemoteWebDriver $driver, array $data)
    {
        $this->activateAccount->resolve($driver, $data);
    }
}
