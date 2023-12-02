<?php

namespace App\Models\Strategy\Pages\Generation;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
class PlaceOfWorkCompanyDetail
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h1'),
                '@.*Declaration.*of.*a.*self-employed.*person.*without.*employees.*@')
        );

        $driver->takeScreenshot('PlaceOfWorkCompanyDetail.png');
        $driver->findElement(WebDriverBy::id('createUpdateCompany'))->click();
    }
}
