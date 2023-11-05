<?php

namespace App\Models;

use Facebook\WebDriver\Cookie;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class Registrar
{
    public function register($formData): array
    {
        $data = [];
        $host = env('SELENIUM_HOST');
        $capabilities = DesiredCapabilities::firefox();
        $driver = RemoteWebDriver::create($host, $capabilities);
        $driver->get('https://www.international.socialsecurity.be/working_in_belgium/en/home.html');
        $driver->takeScreenshot('landing.png');

        //todo does not find an element
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextContains(WebDriverBy::cssSelector('#intro h1 small'), 'Welcome to')
        );

        $driver->findElement(WebDriverBy::linkText('Limosa - Mandatory declaration'))->click();

        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextContains(WebDriverBy::cssSelector('#main h1'), 'Limosa Authentication')
        );

        $driver->takeScreenshot('login.png');

        $driver->findElement(WebDriverBy::id('notYetRegisteredLink'))->click();

        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextContains(WebDriverBy::id('headerTitle'), 'Demand Access')
        );

        $driver->takeScreenshot('register.png');


//        $data['title'][] = $driver->getTitle();
//        $data['current_uri'][] = $driver->getCurrentURL();
//        $historyButton = $driver->findElement(
//            WebDriverBy::cssSelector('#ca-history a')
//        );
//        $data['text_of_element'] = $historyButton->getText() . "'\n";
//        $historyButton->click();
//        $driver->wait()->until(
//            WebDriverExpectedCondition::titleContains('Revision history')
//        );
//        $driver->takeScreenshot('3.png');
//        $data['title'][] =  $driver->getTitle() . "'\n";
//        $data['current_uri'][] =  $driver->getCurrentURL() . "'\n";
//        $driver->manage()->deleteAllCookies();
//        $cookie = new Cookie('cookie_set_by_selenium', 'cookie_value');
//        $driver->manage()->addCookie($cookie);
//
//        $data['cookies'] = $driver->manage()->getCookies();
        $driver->quit();

        return $data;
    }
}
