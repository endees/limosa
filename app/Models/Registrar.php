<?php

namespace App\Models;

use App\Models\Strategy\RegistrationStrategy;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class Registrar
{
    public function __construct(
        private readonly RegistrationStrategy $strategy)
    {
        $host = env('SELENIUM_HOST');
        $capabilities = DesiredCapabilities::firefox();
        $this->driver = RemoteWebDriver::create($host, $capabilities,10000);
    }

    public function register($formData)
    {
        try {
            $this->strategy->execute($this->driver);
        } catch (\Exception $e) {
            $this->driver->quit();
            throw $e;
        }

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
        $this->driver->quit();

    }
}
