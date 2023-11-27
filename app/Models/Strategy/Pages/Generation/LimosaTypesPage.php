<?php

namespace App\Models\Strategy\Pages\Generation;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class LimosaTypesPage
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::id('actionChoiceForm'))
        );

        $driver->takeScreenshot('LimosaTypes.png');

        $driver->findElement(WebDriverBy::cssSelector('input[name="VATSelfEmployed"][value="TRUE"]'))->click();
        $driver->findElement(WebDriverBy::id('createSelfEmployerDeclarationButton'))->click();
    }
}
