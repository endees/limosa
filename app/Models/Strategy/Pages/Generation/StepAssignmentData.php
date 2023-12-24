<?php

namespace App\Models\Strategy\Pages\Generation;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class StepAssignmentData implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h3'),
                '@.*Declare.*a.*period.*and.*a.*sector.*@')
        );
        $driver->findElement(WebDriverBy::id('startDate_input'))->sendKeys($data['start_date']);
        $driver->findElement(WebDriverBy::id('endDate_input'))->sendKeys($data['end_date']);

        $driver->findElement(WebDriverBy::id('activityForSelfEmployed'))->click();

        switch ($data['sector']) {
            case 'construction':
                $driver->findElement(WebDriverBy::cssSelector('#activityForSelfEmployed option[value="NEW.CONSTRUCTION"]'))->click();
                break;
            case 'meat':
                $driver->findElement(WebDriverBy::cssSelector('#activityForSelfEmployed option[value="NEW.MEAT"]'))->click();
                break;
            case 'cleaning':
                $driver->findElement(WebDriverBy::cssSelector('#activityForSelfEmployed option[value="NEW.CLEANING"]'))->click();
                break;
            case 'other':
            default:
                $driver->findElement(WebDriverBy::cssSelector('#activityForSelfEmployed option[value="NEW.OTHER"]'))->click();
                break;
        }

        $driver->takeScreenshot('storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_StepAssignmentData.png');
        $driver->findElement(WebDriverBy::id('nextStepButton'))->click();
    }
}
