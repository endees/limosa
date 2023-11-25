<?php

namespace App\Models\Strategy\Pages;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class Languages implements PageInterface
{
    public function resolve(RemoteWebDriver $driver): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::id('lang-en'), '@.*Log.*in.*@i')
        );

        $driver->takeScreenshot('Languages.png');

        $driver->findElement(WebDriverBy::linkText('Log in'))->click();
    }
}
