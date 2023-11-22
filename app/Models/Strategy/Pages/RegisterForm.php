<?php

namespace App\Models\Strategy\Pages;

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Illuminate\Support\Carbon;

class RegisterForm
{
    public function resolve(RemoteWebDriver $driver, $data): void
    {
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextMatches(WebDriverBy::cssSelector('#page h1'), '@.*Identify.*yourself.*@i')
        );
        $driver->findElement(WebDriverBy::name('register.lastname'))->sendKeys($data['lastname']);
        $driver->findElement(WebDriverBy::name('register.firstname'))->sendKeys($data['firstname']);

        if ('male' === 'male') {
            $driver->findElement(WebDriverBy::id('opt1'))->click();
        }
        $dateObject = Carbon::parse($data['date_of_birth']);
        $day = $dateObject->day;
        $month = $dateObject->month;
        $year = $dateObject->year;
//        identity
        $driver->findElement(WebDriverBy::name('register.birthDateDay'))->sendKeys($day);
        $driver->findElement(WebDriverBy::name('register.birthDateMonth'))->sendKeys($month);
        $driver->findElement(WebDriverBy::name('register.birthDateYear'))->sendKeys($year);
        $driver->findElement(WebDriverBy::cssSelector('#country_5'))->click();
        $driver->findElement(WebDriverBy::cssSelector('#country_5 option[value="122"]'))->click();

//        address
        $driver->findElement(WebDriverBy::name('register.address.street'))->sendKeys($data['street']);
        $driver->findElement(WebDriverBy::name('register.address.streetNumber'))->sendKeys($data['house_number']);
        $driver->findElement(WebDriverBy::name('register.address.box'))->sendKeys($data['flat_number']);
        $driver->findElement(WebDriverBy::name('register.address.postalCode'))->sendKeys($data['postcode']);
        $driver->findElement(WebDriverBy::name('register.address.municipality'))->sendKeys($data['city']);
        $driver->findElement(WebDriverBy::cssSelector('#country'))->click();
        $driver->findElement(WebDriverBy::cssSelector('#country option[value="122"]'))->click();

//        gov identification
        $driver->findElement(WebDriverBy::name('register.foreignNumberValue'))->sendKeys($data['pesel']);
        $driver->findElement(WebDriverBy::name('register.foreignNumberCountry'))->click();
        $driver->findElement(WebDriverBy::cssSelector('select[name="register.foreignNumberCountry"] option[value="122"]'))->click();

        $driver->findElement(WebDriverBy::id('foreignNumberType'))->click();
        $driver->findElement(WebDriverBy::cssSelector('#foreignNumberType option[value="national"]'))->click();

        $driver->findElement(WebDriverBy::cssSelector('input[name="createId.qualityCodeTypeInt"][value="3"]'))->click();

        $driver->takeScreenshot('registerForm.png');

        $driver->findElement(WebDriverBy::cssSelector('input[type="submit"]'))->click();
    }
}
