<?php

namespace App\Models\Strategy\Pages\Generation;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class LoginPage
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('#main h1'), '@.*Limosa.*Authentication.*@')
        );

        $driver->findElement(WebDriverBy::name('j_username'))->sendKeys($data['username']);
        $driver->findElement(WebDriverBy::name('j_password'))->sendKeys($data['password']);

        $driver->takeScreenshot('LoginPageGeneration.png');

        $driver->findElement(WebDriverBy::cssSelector('button[type="submit"]'))->click();
    }
}
