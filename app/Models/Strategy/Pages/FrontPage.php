<?php

namespace App\Models\Strategy\Pages;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class FrontPage implements PageInterface
{
    public function resolve(RemoteWebDriver $driver): void
    {
//        $driver->get('https://www.international.socialsecurity.be/working_in_belgium/en/home.html');
        $driver->takeScreenshot('landing.png');
        //todo does not find an element
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('#intro h1 small'), '@.*welcome.*@i')
        );

        // Get current window handles first:
        $windowHandlesBefore = $driver->getWindowHandles();

        $driver->findElement(WebDriverBy::linkText('Limosa - Mandatory declaration'))->click();

        sleep(5);
        $windowHandlesAfter = $driver->getWindowHandles();
        $newWindowHandle = array_diff($windowHandlesAfter, $windowHandlesBefore);
        $newWindowHandle = reset($newWindowHandle);

        $driver->switchTo()->window($newWindowHandle);
        $driver->takeScreenshot('switched tab.png');
    }
}
