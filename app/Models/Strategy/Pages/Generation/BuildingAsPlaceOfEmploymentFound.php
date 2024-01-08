<?php

namespace App\Models\Strategy\Pages\Generation;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class BuildingAsPlaceOfEmploymentFound implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h3'),
                '@.*Declare.*a.*site.*as.*a.*place.*of.*employment.*@')
        );

        $driver->findElement(WebDriverBy::id('name'))->sendKeys($data['site_name']);
        $driver->findElement(WebDriverBy::id('street'))->sendKeys($data['site_street']);
        $driver->findElement(WebDriverBy::id('streetNumber'))->sendKeys($data['site_house_number']);

        if (!empty($data['site_aparment_number'])) {
            $driver->findElement(WebDriverBy::id('box'))->sendKeys($data['site_aparment_number']);
        }

        $driver->findElement(WebDriverBy::id('belgianPostalCode_label'))->click();
        $driver->findElement(WebDriverBy::id('belgianPostalCode_filter'))->sendKeys($data['site_post_code']);
        $driver->findElement(WebDriverBy::className('ui-state-highlight'))->click();

        $driver->takeScreenshot('storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_BuildingAsPlaceOfEmploymentFound.png');
        $driver->findElement(WebDriverBy::id('createUpdateBuildingSiteButton'))->click();
    }
}
