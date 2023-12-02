<?php

namespace App\Models\Strategy\Pages\Generation;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Illuminate\Support\Carbon;

class StepEmployer
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h3'),
                '@.*Self-employed.*person.*selected.*@')
        );
        sleep(5);
        $driver->takeScreenshot('StepEmployer.png');
        $driver->findElement(WebDriverBy::id('nextStepFromEmployerButton'))->click();
    }
}
