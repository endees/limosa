<?php

namespace App\Models\Strategy;

use App\Models\Strategy\Pages\FrontPage;
use App\Models\Strategy\Pages\IntroPage;
use App\Models\Strategy\Pages\RegisterForm;
use App\Models\Strategy\Pages\RegisterStart;
use App\Models\Strategy\Pages\SecondPage;
use App\Models\Strategy\Pages\LoginPage;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class RegistrationStrategy
{
    protected $pageHandlersFirst = [];

    public function __construct(
        public readonly IntroPage     $introPage,
        public readonly FrontPage     $frontPage,
        public readonly SecondPage    $secondPage,
        public readonly LoginPage     $loginPage,
        public readonly RegisterStart $registerStart,
        public readonly RegisterForm  $registerForm
    )
    {
        $this->pageHandlersFirst = [
            $this->introPage,
            $this->frontPage,
            $this->secondPage,
            $this->loginPage,
            $this->registerStart,
        ];
    }

    public function execute(RemoteWebDriver $driver, array $data)
    {
        foreach ($this->pageHandlersFirst as $pageHandler) {
            $pageHandler->resolve($driver);
        }
        $this->registerForm->resolve($driver, $data);
    }
}
