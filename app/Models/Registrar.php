<?php

namespace App\Models;

use Facebook\WebDriver\Cookie;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

class Registrar
{
    public function register(): array
    {
        $data = [];
        // This is where Selenium server 2/3 listens by default. For Selenium 4, Chromedriver or Geckodriver, use http://localhost:4444/
        $host = 'http://selenium-hub:4444/wd/hub';
        $capabilities = DesiredCapabilities::firefox();
        $driver = RemoteWebDriver::create($host, $capabilities);

        // navigate to Selenium page on Wikipedia
        $driver->get('https://en.wikipedia.org/wiki/Selenium_(software)');

        // write 'PHP' in the search box
        $driver->findElement(WebDriverBy::id('searchInput')) // find search input element
        ->sendKeys('PHP') // fill the search box
        ->submit(); // submit the whole form

        // wait until 'PHP' is shown in the page heading element
        $driver->wait()->until(
            WebDriverExpectedCondition::elementTextContains(WebDriverBy::id('firstHeading'), 'PHP')
        );

        // print title of the current page to output
        $data['title'][] = $driver->getTitle();
        // print URL of current page to output
        $data['current_uri'][] = $driver->getCurrentURL();

        // find element of 'History' item in menu
        $historyButton = $driver->findElement(
            WebDriverBy::cssSelector('#ca-history a')
        );

        // read text of the element and print it to output
        $data['text_of_element'] = $historyButton->getText() . "'\n";

        // click the element to navigate to revision history page
        $historyButton->click();

        // wait until the target page is loaded
        $driver->wait()->until(
            WebDriverExpectedCondition::titleContains('Revision history')
        );

        // print the title of the current page
        $data['title'][] =  $driver->getTitle() . "'\n";

        // print the URI of the current page
        $data['current_uri'][] =  $driver->getCurrentURL() . "'\n";

        // delete all cookies
        $driver->manage()->deleteAllCookies();

        // add new cookie
        $cookie = new Cookie('cookie_set_by_selenium', 'cookie_value');
        $driver->manage()->addCookie($cookie);

        // dump current cookies to output
        $data['cookies'] = $driver->manage()->getCookies();

        // terminate the session and close the browser
        $driver->quit();

        return $data;
    }
}
