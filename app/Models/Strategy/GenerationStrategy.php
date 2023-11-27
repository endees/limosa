<?php

namespace App\Models\Strategy;

use App\Models\Strategy\Pages\Generation\LimosaFirstPage;
use App\Models\Strategy\Pages\Generation\LimosaTypesPage;
use App\Models\Strategy\Pages\Registration\FrontPage;
use App\Models\Strategy\Pages\Registration\IntroPage;
use App\Models\Strategy\Pages\Registration\Languages;
use App\Models\Strategy\Pages\Generation\LoginPage;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class GenerationStrategy
{
    protected $pageHandlersFirst = [];

    public function __construct(
        public readonly IntroPage $introPage,
        public readonly FrontPage $frontPage,
        public readonly Languages $languages,
        public readonly LoginPage $loginPage,
        public readonly LimosaTypesPage $limosaTypesPage,
        public readonly LimosaFirstPage $limosaFirstPage
    ) {
        $this->pageHandlersFirst = [
            $this->introPage,
            $this->frontPage,
            $this->languages
        ];
    }

    public function execute(RemoteWebDriver $driver, array $data)
    {
        foreach ($this->pageHandlersFirst as $pageHandler) {
            $pageHandler->resolve($driver);
        }
        $this->loginPage->resolve($driver, $data);
        $this->limosaTypesPage->resolve($driver, $data);
        $this->limosaFirstPage->resolve($driver, $data);
    }
}
