<?php

namespace App\Models\Strategy\Pages\Generation;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Illuminate\Support\Carbon;

class StepOverview
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('#stepOverviewForm h2'),
                '@.*Preview.*of.*the.*declaration.*@')
        );

        $driver->takeScreenshot('storage/screenshots/StepOverview.png');
        $driver->findElement(WebDriverBy::id('nextStepButton'))->click();
    }
}
