<?php

namespace App\Models\Strategy\Pages\Generation\ByVat;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class PlaceOfWorkCompanySearchByVat implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h3'),
                '@.*Declare.*a.*company.*as.*a.*place.*of.*employment.*@')
        );

        $driver->findElement(WebDriverBy::id('kboNumber'))->sendKeys($data['nip_place_of_work'][$data['nip_place_of_work_current']]);
        if(config('app.debug') === true) {
            $driver->takeScreenshot('storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_PlaceOfWorkCompanySearchByVat.png');
        }
        $driver->findElement(WebDriverBy::id('searchByKboNumberButton'))->click();
    }
}
