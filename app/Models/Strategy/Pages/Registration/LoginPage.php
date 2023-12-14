<?php

namespace App\Models\Strategy\Pages\Registration;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class LoginPage implements PageInterface
{
    public function resolve($driver): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('#main h1'), '@.*Limosa.*Authentication.*@')
        );

        $driver->takeScreenshot( 'storage/screenshots/registration/LoginPage.png');

        // Get current window handles first:
        $windowHandlesBefore = $driver->getWindowHandles();

        $driver->findElement(WebDriverBy::id('notYetRegisteredLink'))->click();

        sleep(5);
        $windowHandlesAfter = $driver->getWindowHandles();
        $newWindowHandle = array_diff($windowHandlesAfter, $windowHandlesBefore);
        $newWindowHandle = reset($newWindowHandle);

        $driver->switchTo()->window($newWindowHandle);
        $driver->takeScreenshot('storage/screenshots/registration/LoginPage2.png');

    }
}
