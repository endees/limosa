<?php

namespace App\Models\Strategy\Pages\Generation;

use App\Models\Strategy\Pages\Interface\PageInterface;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Illuminate\Support\Carbon;

class LimosaFirstPage implements PageInterface
{
    public function resolve(RemoteWebDriver $driver, array $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h3'),
                '@.*Details.*of.*the.*employer.*@')
        );
        sleep(3);
        $goNextElement = WebDriverBy::id('saveEmployerButton');

        if (WebDriverExpectedCondition::visibilityOfElementLocated($goNextElement)) {
            $driver->takeScreenshot('storage/screenshots/generation/' . $data['jobUUID'] . '/' . $data['sequence'] . '_beforeScroll.png');
            $driver->findElement(WebDriverBy::xpath("//*[contains(text(),'Personal details')]"))->click();
            $driver->takeScreenshot('storage/screenshots/generation/' . $data['jobUUID'] . '/' . $data['sequence'] . '_afterScroll.png');

            $driver->findElement($goNextElement)->getLocationOnScreenOnceScrolledIntoView();

            //        personal details
            $driver->findElement(WebDriverBy::id('lastName'))->sendKeys($data['lastname']);
            $driver->findElement(WebDriverBy::id('firstName'))->sendKeys($data['firstname']);

            if ($data['gender'] === 'female') {
                $driver->findElement(WebDriverBy::cssSelector('input[name="genderString"][value="1"]'))->click();
            } else {
                $driver->findElement(WebDriverBy::cssSelector('input[name="genderString"][value="0"]'))->click();
            }

            $dateObject = Carbon::createFromFormat('d/m/Y', $data['date_of_birth']);
            $day = $dateObject->day;
            $month = $dateObject->month;
            $year = $dateObject->year;

            $driver->findElement(WebDriverBy::id('birthDateDay'))->sendKeys($day);

            $driver->findElement(WebDriverBy::id('birthDateMonth'))->sendKeys($month);
            $driver->findElement(WebDriverBy::id('birthDateYear'))->sendKeys($year);

            $driver->findElement(WebDriverBy::id('nationalities'))->getLocationOnScreenOnceScrolledIntoView();
            $driver->findElement(WebDriverBy::id('nationalities'))->click();
            $driver->findElement(WebDriverBy::cssSelector('#nationalities option[value="122"]'))->click();

            // address
            $driver->findElement(WebDriverBy::id('phoneticAddressaddressCountry'))->getLocationOnScreenOnceScrolledIntoView();
            $driver->findElement(WebDriverBy::id('phoneticAddressaddressCountry'))->click();
            $driver->findElement(WebDriverBy::cssSelector('#phoneticAddressaddressCountry option[value="122"]'))->click();
            sleep(5);

            $driver->findElement(WebDriverBy::id('phoneticAddressstreet'))->sendKeys($data['street']);
            $driver->findElement(WebDriverBy::name('phoneticAddressstreetNumber'))->sendKeys($data['house_number']);
            $driver->findElement(WebDriverBy::name('phoneticAddressbox'))->sendKeys($data['flat_number']);
            $driver->findElement(WebDriverBy::name('phoneticAddresspostalCode'))->sendKeys($data['postcode']);
            $driver->findElement(WebDriverBy::name('phoneticAddressmunicipality'))->sendKeys($data['city']);

            //        identification number
            $driver->findElement(WebDriverBy::id('phoneticForeignNumberTypeString'))->click();
            $driver->findElement(WebDriverBy::cssSelector('#phoneticForeignNumberTypeString option[value="1"]'))->click();

            $driver->findElement(WebDriverBy::name('phoneticForeignNumber'))->sendKeys($data['pesel']);

            $driver->findElement(WebDriverBy::id('phoneticForeignNumberCountryString'))->click();
            $driver->findElement(WebDriverBy::cssSelector('#phoneticForeignNumberCountryString option[value="122"]'))->click();
        } else {
            // @todo manual encoding
        }
        $driver->takeScreenshot('storage/screenshots/generation/' . $data['jobUUID'] . '/' . $data['sequence'] . '_LimosaFirstPage.png');
        $driver->findElement($goNextElement)->click();
    }
}
