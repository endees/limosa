<?php

namespace App\Models\Strategy\Pages\Generation;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Illuminate\Support\Carbon;

class OverviewPrint
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h2'),
                '@.*Declaration(s).*submitted.*@')
        );

//        $goNextElement = WebDriverBy::id('nextStepFromEmployerButton');
        $driver->takeScreenshot('OverviewPrint.png');
        $driver->findElement(WebDriverBy::id('j_idt33:declarationCertificatesDatatable:0:downloadPdfEnLink'))
            ->click();

        sleep(10);
    }
}
