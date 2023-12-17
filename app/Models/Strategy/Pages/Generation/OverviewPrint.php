<?php

namespace App\Models\Strategy\Pages\Generation;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class OverviewPrint implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h3'),
                '@.*Declaration\(s\).*submitted.*@')
        );

        $driver->takeScreenshot('storage/screenshots/generation/' . $data['jobUUID'] . '/' . $data['sequence'] . '_OverviewPrint.png');
        $driver->findElement(WebDriverBy::id('j_idt33:declarationCertificatesDatatable:0:downloadPdfEnLink'))->click();
        sleep(10);
    }
}
