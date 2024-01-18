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

        if (config('app.debug') === true) {
            $driver->takeScreenshot('storage/screenshots/' . $data['jobUUID'] . '/' . $data['sequence'] . '_OverviewPrint.png');
        }

        foreach(array_keys($data['limosalanguage']) as $code ) {
            switch ($code) {
                case 'nl':
                    $driver->findElement(WebDriverBy::id('j_idt33:declarationCertificatesDatatable:0:downloadPdfNlLink'))->click();
                    sleep(10);
                    break;
                case 'fr':
                    $driver->findElement(WebDriverBy::id('j_idt33:declarationCertificatesDatatable:0:downloadPdfFrLink'))->click();
                    sleep(10);
                    break;
                case 'de':
                    $driver->findElement(WebDriverBy::id('j_idt33:declarationCertificatesDatatable:0:downloadPdfDeLink'))->click();
                    sleep(10);
                    break;
                case 'en':
                default:
                    $driver->findElement(WebDriverBy::id('j_idt33:declarationCertificatesDatatable:0:downloadPdfEnLink'))->click();
                    sleep(10);
            }
        }
        sleep(10);
    }
}
