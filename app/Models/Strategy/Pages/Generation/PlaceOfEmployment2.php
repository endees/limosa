<?php

namespace App\Models\Strategy\Pages\Generation;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class PlaceOfEmployment2
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h3'),
                '@.*Place.*of.*employment.*selected.*@')
        );
        $driver->takeScreenshot('PlaceOfEmployment2.png');
        $driver->findElement(WebDriverBy::id('nextStepFromPOWButton'))->click();
    }
}
