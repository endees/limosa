<?php

namespace App\Models\Strategy\Pages\Registration;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class LastRegistrationPage implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
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

        if(config('app.debug') === true) {
            $driver->takeScreenshot( 'storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_LastRegistrationPage.png');
        }

        $driver->findElement(WebDriverBy::cssSelector('input[type="submit"]'))->click();
    }
}
