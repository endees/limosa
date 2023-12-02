<?php

namespace App\Models\Strategy\Pages\Generation;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class StepBelgianClient
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h3'),
                '@.*Declare.*a.*Belgian.*client.*@')
        );
        $driver->takeScreenshot('StepBelgianClient.png');
        $driver->findElement(WebDriverBy::id('stepBelgianClientForm:nextStepFromBelgianClientButton'))->click();
    }
}
