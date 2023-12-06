<?php

namespace App\Models\Strategy\Pages\Generation;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class StepAssignmentData
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h3'),
                '@.*Declare.*a.*period.*and.*a.*sector.*@')
        );
        $driver->findElement(WebDriverBy::id('startDate_input'))->sendKeys($data['start_date']);
        $driver->findElement(WebDriverBy::id('endDate_input'))->sendKeys($data['end_date']);

        $driver->findElement(WebDriverBy::id('activityForSelfEmployed'))->click();
        $driver->findElement(WebDriverBy::cssSelector('#activityForSelfEmployed option[value="NEW.CONSTRUCTION"]'))->click();

        $driver->takeScreenshot('StepAssignmentData.png');
        $driver->findElement(WebDriverBy::id('nextStepButton'))->click();
    }
}
