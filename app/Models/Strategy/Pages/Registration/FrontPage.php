<?php

namespace App\Models\Strategy\Pages\Registration;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class FrontPage implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
    {
//        $driver->get('https://www.international.socialsecurity.be/working_in_belgium/en/home.html');

        //todo does not find an element
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('#intro h1 small'), '@.*welcome.*@i')
        );

        // Get current window handles first:
        $windowHandlesBefore = $driver->getWindowHandles();

        if(config('app.debug') === true) {
            $driver->takeScreenshot('storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_FrontPage.png');
        }
        $driver->findElement(WebDriverBy::linkText('Limosa - Mandatory declaration'))->click();

        sleep(5);
        $windowHandlesAfter = $driver->getWindowHandles();
        $newWindowHandle = array_diff($windowHandlesAfter, $windowHandlesBefore);
        $newWindowHandle = reset($newWindowHandle);

        $driver->switchTo()->window($newWindowHandle);
    }
}
