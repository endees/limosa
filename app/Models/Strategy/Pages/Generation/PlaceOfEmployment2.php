<?php

namespace App\Models\Strategy\Pages\Generation;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class PlaceOfEmployment2 implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h3'),
                '@.*Place.*of.*employment.*selected.*@')
        );
        $driver->takeScreenshot('storage/screenshots/generation/' . $data['jobUUID'] . '/' . $data['sequence'] . '_PlaceOfEmployment2.png');
        $driver->findElement(WebDriverBy::id('nextStepFromPOWButton'))->click();
    }
}
