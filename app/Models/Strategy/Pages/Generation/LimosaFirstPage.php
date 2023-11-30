<?php

namespace App\Models\Strategy\Pages\Generation;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Illuminate\Support\Carbon;

class LimosaFirstPage
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('h1'),
                '@.*Declaration.*of.*a.*self-employed.*person.*without.*employees.*@')
        );

        $goNextElement = WebDriverBy::id('saveEmployerButton');

        if (WebDriverExpectedCondition::visibilityOfElementLocated($goNextElement)) {
            $driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::cssSelector('div#j_idt155_header')));
            $driver->findElement(WebDriverBy::cssSelector('div#j_idt155_header'))->click();

            $driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('email')));

            //        contact information
            $driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('email')));
            $driver->findElement(WebDriverBy::id('email'))->sendKeys($data['address']);

            $driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('phoneNumber')));
            $driver->findElement(WebDriverBy::id('phoneNumber'))->sendKeys('+48792651641');

            //        personal details
            $driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('lastName')));
            $driver->findElement(WebDriverBy::id('lastName'))->sendKeys($data['lastname']);

            $driver->wait()->until(WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::id('firstName')));
            $driver->findElement(WebDriverBy::id('firstName'))->sendKeys($data['firstname']);

            // todo
            if ('male' === 'male') {
                $driver->findElement(WebDriverBy::name('genderString'))->getLocationOnScreenOnceScrolledIntoView();
                $driver->findElement(WebDriverBy::name('genderString'))->click();
            }
            $dateObject = Carbon::parse($data['date_of_birth']);
            $day = $dateObject->day;
            $month = $dateObject->month;
            $year = $dateObject->year;

            $driver->findElement(WebDriverBy::id('birthDateDay'))->getLocationOnScreenOnceScrolledIntoView();
            $driver->findElement(WebDriverBy::id('birthDateDay'))->sendKeys($day);

            $driver->findElement(WebDriverBy::id('birthDateMonth'))->sendKeys($month);
            $driver->findElement(WebDriverBy::id('birthDateYear'))->sendKeys($year);

            $driver->findElement(WebDriverBy::id('nationalities'))->getLocationOnScreenOnceScrolledIntoView();
            $driver->findElement(WebDriverBy::id('nationalities'))->click();
            $driver->findElement(WebDriverBy::cssSelector('#nationalities option[value="122"]'))->click();

//        address
            $driver->findElement(WebDriverBy::id('phoneticAddressaddressCountry'))->getLocationOnScreenOnceScrolledIntoView();
            $driver->findElement(WebDriverBy::id('phoneticAddressaddressCountry'))->click();
            $driver->findElement(WebDriverBy::cssSelector('#phoneticAddressaddressCountry option[value="122"]'))->click();

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

            $driver->findElement($goNextElement)->click();
        } else {
            // @todo manual encoding
        }
        $driver->takeScreenshot('LimosaFirstPage.png');
    }
}
