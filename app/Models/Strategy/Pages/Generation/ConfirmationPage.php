<?php

namespace App\Models\Strategy\Pages\Generation;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class ConfirmationPage
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->get($data['activation_link']);
        $driver->takeScreenshot('ConfirmationPage.png');

        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(
                WebDriverBy::cssSelector('#logoUrl a'), '@.*International\.socialsecurity\.be*@i'
            )
        );

        $driver->findElement(WebDriverBy::linkText('English'))->click();
    }
}
