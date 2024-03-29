<?php

namespace App\Models\Strategy\Pages\Registration;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class RegisterStart implements PageInterface
{
    public function resolve($driver, array $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::id('headerTitle'), '@.*Demand.*access.*@i')
        );

        if(config('app.debug') === true) {
            $driver->takeScreenshot( 'storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_RegisterStart.png');
        }

        $driver->findElement(WebDriverBy::id('selectRegistrationByPersonalDataButton'))->click();
    }
}
