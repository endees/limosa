<?php

namespace App\Models\Strategy\Pages\Generation;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class PlaceOfEmployment
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h3'),
                '@.*Declare.*place.*of.*employment.*@')
        );
        $driver->takeScreenshot('storage/screenshots/PlaceOfEmployment.png');
        $driver->findElement(WebDriverBy::id('addCompanyLink'))->click();
    }
}
