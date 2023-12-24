<?php

namespace App\Models\Strategy\Pages\Registration;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class ActivateAccount implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
    {
        $driver->get($data['activation_link']);

        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(
                WebDriverBy::cssSelector('p.helpBox'), '@.*Your.*account.*has.*been.*activated.*@i'
            )
        );

        $driver->takeScreenshot('storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_ActivateAccount.png');
    }
}
