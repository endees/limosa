<?php

namespace App\Models\Strategy\Pages;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class ThirdPage implements PageInterface
{
    public function resolve($driver): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextContains(WebDriverBy::cssSelector('#main h1'), 'Demand Access')
        );

        $driver->takeScreenshot('register.png');

        $driver->findElement(WebDriverBy::id('notYetRegisteredLink'))->click();
    }
}
