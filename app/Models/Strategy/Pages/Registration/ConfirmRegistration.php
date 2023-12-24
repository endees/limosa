<?php

namespace App\Models\Strategy\Pages\Registration;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class ConfirmRegistration implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(
                WebDriverBy::cssSelector('#page h1'), '@.*Confirm.*@i'
            )
        );

        $driver->takeScreenshot( 'storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_ConfirmRegistration.png');

        $driver->findElement(WebDriverBy::cssSelector('input[type="submit"]'))->click();
    }
}
