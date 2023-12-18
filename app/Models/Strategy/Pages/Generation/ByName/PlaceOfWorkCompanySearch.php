<?php

namespace App\Models\Strategy\Pages\Generation\ByName;

use App\Models\BelgianCompany as BelgianCompanyModel;
use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Illuminate\Database\Query\Builder;

class PlaceOfWorkCompanySearch implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h3'),
                '@.*Declare.*a.*company.*as.*a.*place.*of.*employment.*@')
        );

        /** @var Builder $existingCompany */
        $existingCompany = BelgianCompanyModel::where('identifier', 'BE' . $data['belgian_nip']);
        $businessName = $existingCompany->first()->payload;
        $data['business_name'] = $businessName;

        $driver->findElement(WebDriverBy::id('tradingName'))->sendKeys($data['business_name']);

        /** TODO HARDDCODED POSTCODE */
        $driver->findElement(WebDriverBy::id('belgianPostalCode_label'))->click();
        sleep(2);
        $driver->findElement(WebDriverBy::id('belgianPostalCode_29'))->click();
        sleep(2);

        $driver->takeScreenshot('storage/screenshots/generation/' . $data['jobUUID'] . '/' . $data['sequence'] . '_PlaceOfWorkCompanySearch.png');
        $driver->findElement(WebDriverBy::id('searchCompanyButton'))->click();
    }
}