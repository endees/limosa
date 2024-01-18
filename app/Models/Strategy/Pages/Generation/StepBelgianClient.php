<?php

namespace App\Models\Strategy\Pages\Generation;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class StepBelgianClient implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h3'),
                '@.*Search.*for.*a.*Belgian.*client.*@')
        );

        $driver->findElement(WebDriverBy::id('kboNumber'))->sendKeys($data['belgian_nip']);
        if(config('app.debug') === true) {
            $driver->takeScreenshot('storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_StepBelgianClient.png');
        }
        $driver->findElement(WebDriverBy::id('searchByKboNumberButton'))->click();

        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h3'),
                '@.*Company.*matching.*the.*criterion.*entered.*@')
        );

        if(config('app.debug') === true) {
            $driver->takeScreenshot('storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_StepBelgianClient2.png');
        }

        $driver->findElement(WebDriverBy::id('createUpdateBelgianClient'))->click();
    }
}
