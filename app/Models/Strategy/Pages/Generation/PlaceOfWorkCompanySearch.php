<?php

namespace App\Models\Strategy\Pages\Generation;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
class PlaceOfWorkCompanySearch
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h3'),
                '@.*Declare.*a.*company.*as.*a.*place.*of.*employment.*@')
        );

        $driver->findElement(WebDriverBy::id('tradingName'))->sendKeys($data['business_name']);

        $driver->findElement(WebDriverBy::id('belgianPostalCode_label'))->click();
        sleep(2);
        $driver->findElement(WebDriverBy::id('belgianPostalCode_29'))->click();
        sleep(2);

        $driver->takeScreenshot('storage/screenshots/PlaceOfWorkCompanySearch.png');
        $driver->findElement(WebDriverBy::id('searchCompanyButton'))->click();
    }
}
