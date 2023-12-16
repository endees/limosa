<?php

namespace App\Models\Strategy\Pages\Generation;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class StepOverview implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('#stepOverviewForm h2'),
                '@.*Preview.*of.*the.*declaration.*@')
        );

        $driver->takeScreenshot('storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_' . $data['jobUUID'] . '/' . $data['sequence'] . '_StepOverview.png');
        $driver->findElement(WebDriverBy::id('nextStepButton'))->click();
    }
}
