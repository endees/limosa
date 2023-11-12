<?php

namespace App\Models\Strategy\Pages;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class RegisterFormPage implements PageInterface
{
    public function resolve($driver): void
    {
        $driver->takeScreenshot('register.png');

        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::id('headerTitle'), '@.*Demand.*access.*@i')
        );

        $driver->findElement(WebDriverBy::id('selectRegistrationByPersonalDataButton'))->click();
    }
}
