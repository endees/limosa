<?php

namespace App\Models\Strategy\Pages\Generation;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class CompanyAsPlaceOfEmploymentFound implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h1'),
                '@.*Declaration.*of.*a.*self-employed.*person.*without.*employees.*@')
        );

        if(config('app.debug') === true) {
            $driver->takeScreenshot('storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_CompanyAsPlaceOfEmploymentFound.png');
        }
        $driver->findElement(WebDriverBy::id('createUpdateCompany'))->click();
    }
}
