<?php

namespace App\Models\Strategy\Pages\Generation;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class LimosaTypesPage implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
    {
        sleep(5);
        $driver->wait()->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('actionChoiceForm'))
        );

        $driver->findElement(WebDriverBy::cssSelector('input[name="VATSelfEmployed"][value="TRUE"]'))->click();
        $driver->findElement(WebDriverBy::cssSelector('#employerCountrySelfEmployed option[value="122"]'))->click();
        $driver->findElement(WebDriverBy::id('vatNumberSelfEmployed'))->sendKeys('PL' . $data['nip']);

        if (config('app.debug') === true) {
            $driver->takeScreenshot('storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_LimosaTypes.png');
        }
        $driver->findElement(WebDriverBy::id('createSelfEmployerDeclarationButton'))->click();
    }
}
