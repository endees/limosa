<?php

namespace App\Models\Strategy;

use App\Models\Strategy\Pages\FrontPage;
use App\Models\Strategy\Pages\IntroPage;
use App\Models\Strategy\Pages\RegisterFormPage;
use App\Models\Strategy\Pages\SecondPage;
use App\Models\Strategy\Pages\LoginPage;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class RegistrationStrategy
{
    protected $pageHandlers = [];

    public function __construct(
        public readonly IntroPage        $introPage,
        public readonly FrontPage        $frontPage,
        public readonly SecondPage       $secondPage,
        public readonly LoginPage        $loginPage,
        public readonly RegisterFormPage $registerFormPage,
    ) {
        $this->pageHandlers = [
            $this->introPage,
            $this->frontPage,
            $this->secondPage,
            $this->loginPage,
            $this->registerFormPage,
        ];
    }

    public function execute(RemoteWebDriver $driver) {
        foreach ($this->pageHandlers as $pageHandler) {
            $pageHandler->resolve($driver);
        }
    }
}
