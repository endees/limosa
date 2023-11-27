<?php

namespace App\Models;

use App\Models\Strategy\AccountActivationStrategy;
use App\Models\Strategy\GenerationStrategy;
use App\Models\Strategy\RegistrationStrategy;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class DriverHandler
{
    public function __construct(
        private readonly RegistrationStrategy $registrationStrategy,
        private readonly GenerationStrategy   $generationStrategy,
        private readonly AccountActivationStrategy   $accountActivationStrategy
    ) {
    }

    public function register(array $data)
    {
        $host = env('SELENIUM_HOST');
        $capabilities = DesiredCapabilities::firefox();
        $driver = RemoteWebDriver::create($host, $capabilities,30000, 30000);

        try {
            $driver->takeScreenshot('startRegistration.png');
            $this->registrationStrategy->execute($driver, $data);
        } catch (\Exception $e) {
            $driver->takeScreenshot('endRegistration.png');
            $driver->quit();
            throw $e;
        }
        $driver->wait(10);
        $driver->takeScreenshot('endRegistration.png');
        $driver->quit();
    }

    public function activateAccount(array $data) {
        $host = env('SELENIUM_HOST');
        $capabilities = DesiredCapabilities::firefox();
        $driver = RemoteWebDriver::create($host, $capabilities,30000, 30000);

        try {
            $driver->takeScreenshot('startActivatin.png');
            $this->accountActivationStrategy->execute($driver, $data);
        } catch (\Exception $e) {
            $driver->takeScreenshot('endActivation.png');
            $driver->quit();
            throw $e;
        }
        $driver->wait(10);
        $driver->takeScreenshot('end.png');
        $driver->quit();
    }

    public function generateLimosa(array $data)
    {
        $host = env('SELENIUM_HOST');
        $capabilities = DesiredCapabilities::firefox();
        $driver = RemoteWebDriver::create($host, $capabilities,30000, 30000);

        try {
            $driver->takeScreenshot('startLimosaGeneration.png');
            $this->generationStrategy->execute($driver, $data);
        } catch (\Exception $e) {
            $driver->takeScreenshot('endLimosaGeneration.png');
            $driver->quit();
            throw $e;
        }
        $driver->wait(10);
        $driver->takeScreenshot('end.png');
        $driver->quit();
    }
}
