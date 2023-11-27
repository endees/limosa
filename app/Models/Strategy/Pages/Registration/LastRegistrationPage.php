<?php

namespace App\Models\Strategy\Pages\Registration;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class LastRegistrationPage
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(
                WebDriverBy::cssSelector('#page h1'), '@.*Create.*a.*new.*account.*@i'
            )
        );

        $driver->findElement(WebDriverBy::name('createId.userId'))->sendKeys($data['username']);
        $driver->findElement(WebDriverBy::name('createId.password'))->sendKeys($data['password']);
        $driver->findElement(WebDriverBy::name('createId.passwordConf'))->sendKeys($data['password']);
        $driver->findElement(WebDriverBy::name('createId.email'))->sendKeys($data['address']);

        $driver->findElement(WebDriverBy::name('createId.secretQuestion'))->sendKeys($data['username']);
        $driver->findElement(WebDriverBy::name('createId.answer'))->sendKeys($data['password']);

        $driver->takeScreenshot( 'LastRegistrationPage.png');

        $driver->findElement(WebDriverBy::cssSelector('input[type="submit"]'))->click();
    }
}
