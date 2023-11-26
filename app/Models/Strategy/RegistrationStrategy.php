<?php

namespace App\Models\Strategy;

use App\Models\Strategy\Pages\Registration\ConfirmRegistration;
use App\Models\Strategy\Pages\Registration\FrontPage;
use App\Models\Strategy\Pages\Registration\IntroPage;
use App\Models\Strategy\Pages\Registration\Languages;
use App\Models\Strategy\Pages\Registration\LastRegistrationPage;
use App\Models\Strategy\Pages\Registration\LoginPage;
use App\Models\Strategy\Pages\Registration\RegisterForm;
use App\Models\Strategy\Pages\Registration\RegisterStart;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class RegistrationStrategy
{
    protected $pageHandlersFirst = [];

    public function __construct(
        public readonly IntroPage            $introPage,
        public readonly FrontPage            $frontPage,
        public readonly Languages            $languages,
        public readonly LoginPage            $loginPage,
        public readonly RegisterStart        $registerStart,
        public readonly RegisterForm         $registerForm,
        public readonly LastRegistrationPage $lastRegistrationPage,
        public readonly ConfirmRegistration $confirmRegistration
    )
    {
        $this->pageHandlersFirst = [
            $this->introPage,
            $this->frontPage,
            $this->languages,
            $this->loginPage,
            $this->registerStart,
        ];
        $this->pageHandlersSecond = [
            $this->confirmRegistration
        ];
    }

    public function execute(RemoteWebDriver $driver, array $data)
    {
        foreach ($this->pageHandlersFirst as $pageHandler) {
            $pageHandler->resolve($driver);
        }

        $this->registerForm->resolve($driver, $data);

        $this->lastRegistrationPage->resolve($driver, $data);

        foreach ($this->pageHandlersSecond as $pageHandler) {
            $pageHandler->resolve($driver);
        }
    }
}
