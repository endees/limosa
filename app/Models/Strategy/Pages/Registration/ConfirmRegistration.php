<?php

namespace App\Models\Strategy\Pages\Registration;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class ConfirmRegistration
{
    public function resolve(RemoteWebDriver $driver): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(
                WebDriverBy::cssSelector('#page h1'), '@.*Confirm.*@i'
            )
        );

        $driver->takeScreenshot( 'ConfirmRegistration.png');

        $driver->findElement(WebDriverBy::cssSelector('input[type="submit"]'))->click();
    }
}
