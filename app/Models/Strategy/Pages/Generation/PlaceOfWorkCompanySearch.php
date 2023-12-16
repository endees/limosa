<?php

namespace App\Models\Strategy\Pages\Generation;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
class PlaceOfWorkCompanySearch implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
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

        $driver->takeScreenshot('storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_PlaceOfWorkCompanySearch.png');
        $driver->findElement(WebDriverBy::id('searchCompanyButton'))->click();
    }
}
