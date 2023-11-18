<?php

namespace App\Models;

use App\Models\Strategy\RegistrationStrategy;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class Registrar
{
    public function __construct(
        private readonly RegistrationStrategy $strategy
    ) {
    }

    public function register(array $data)
    {
        $host = env('SELENIUM_HOST');
        $capabilities = DesiredCapabilities::firefox();
        $driver = RemoteWebDriver::create($host, $capabilities,30000, 30000);

        try {
            $driver->takeScreenshot('start.png');
            $this->strategy->execute($driver, $data);
        } catch (\Exception $e) {
            $driver->takeScreenshot('end.png');
            $driver->quit();
            throw $e;
        }

        $driver->takeScreenshot('end.png');
        $driver->quit();
    }
}
