<?php

namespace App\Models\Strategy\Pages\Generation;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class LimosaFirstPage
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h1'),
                '@.*Declaration.*of.*a.*self-employed.*person.*without.*employees.*@')
        );

        $driver->takeScreenshot('LimosaFirstPage.png');

//        $driver->findElement(WebDriverBy::cssSelector('input[name="VATSelfEmployed"][value="FALSE"]'))->click();
//        $driver->findElement(WebDriverBy::id('createSelfEmployerDeclarationButton'))->click();
    }
}
