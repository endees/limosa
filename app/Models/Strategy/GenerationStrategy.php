<?php

namespace App\Models\Strategy;

use App\Models\Strategy\Pages\Generation\ConfirmationPage;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class GenerationStrategy
{
    protected $pageHandlersFirst = [];

    public function __construct(
        private readonly ConfirmationPage $confirmationPage
    )
    {
        $this->pageHandlersFirst = [
        ];
    }

    public function execute(RemoteWebDriver $driver, array $data)
    {
        $this->confirmationPage->resolve($driver, $data);
    }
}
