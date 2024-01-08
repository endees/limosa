<?php

namespace App\Models\Strategy\Pages\Generation;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class AddBelgianClient implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h3'),
                '@.*Declare.*a.*Belgian.*client.*@')
        );
        $driver->takeScreenshot('storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_AddBelgianClient.png');

        $driver->findElement(WebDriverBy::id('stepBelgianClientForm:newClientLink'))->click();
    }
}
