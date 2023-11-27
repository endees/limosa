<?php

namespace App\Models\Strategy\Pages\Registration;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class ActivateAccount
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->get($data['activation_link']);

        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(
                WebDriverBy::cssSelector('p.helpBox'), '@.*Your.*account.*has.*been.*activated.*A.*confirmation.*e-mail.*has.*been.*sent.*to.*'.$data['address'].'.*@i'
            )
        );

        $driver->takeScreenshot('ActivateAccount.png');
    }
}
