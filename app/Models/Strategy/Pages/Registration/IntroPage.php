<?php

namespace App\Models\Strategy\Pages\Registration;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class IntroPage implements PageInterface
{
    public function resolve(RemoteWebDriver $driver): void
    {
        $driver->get('https://www.limosa.be/');

        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(
                WebDriverBy::cssSelector('#logoUrl a'), '@.*International\.socialsecurity\.be*@i'
            )
        );

        $driver->takeScreenshot('storage/screenshots/IntroPage.png');

        $driver->findElement(WebDriverBy::linkText('English'))->click();
    }
}
