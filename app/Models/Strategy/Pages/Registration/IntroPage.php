<?php

namespace App\Models\Strategy\Pages\Registration;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class IntroPage implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
    {
        $driver->get('https://www.limosa.be/');

        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(
                WebDriverBy::cssSelector('#logoUrl a'), '@.*International\.socialsecurity\.be*@i'
            )
        );

        if(config('app.debug') === true) {
            $driver->takeScreenshot('storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_IntroPage.png');
        }

        $driver->findElement(WebDriverBy::linkText('English'))->click();
    }
}
