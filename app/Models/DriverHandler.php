<?php

namespace App\Models;

use App\Models\Strategy\AccountActivationStrategy;
use App\Models\Strategy\GenerationStrategy;
use App\Models\Strategy\RegistrationStrategy;
use Facebook\WebDriver\Firefox\FirefoxOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverDimension;

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
        $driver = $this->prepareDriver();

        try {
            $driver->takeScreenshot('storage/screenshots/startRegistration.png');
            $this->registrationStrategy->execute($driver, $data);
        } catch (\Exception $e) {
            $driver->takeScreenshot('storage/screenshots/endRegistration.png');
            $driver->quit();
            throw $e;
        }
        $driver->wait(10);
        $driver->takeScreenshot('storage/screenshots/endRegistration.png');
        $driver->quit();
    }

    public function activateAccount(array $data) {
        $driver = $this->prepareDriver();

        try {
            $driver->takeScreenshot('storage/screenshots/startActivatin.png');
            $this->accountActivationStrategy->execute($driver, $data);
        } catch (\Exception $e) {
            $driver->takeScreenshot('storage/screenshots/endActivation.png');
            $driver->quit();
            throw $e;
        }
        $driver->wait(10);
        $driver->takeScreenshot('storage/screenshots/end.png');
        $driver->quit();
    }

    public function generateLimosa(array $data)
    {
        $driver = $this->prepareDriver();
        try {
            $driver->takeScreenshot('storage/screenshots/'. $data['jobUUID'] .'/startLimosaGeneration.png');
            $this->generationStrategy->execute($driver, $data);
        } catch (\Exception $e) {
            $driver->takeScreenshot('storage/screenshots/'. $data['jobUUID'] .'/endLimosaGeneration.png');
            $driver->quit();
            throw $e;
        }
        $driver->wait(10);
        $driver->takeScreenshot('storage/screenshots/end.png');
        $driver->quit();
    }

    private function prepareDriver(): RemoteWebDriver
    {
        $host = env('SELENIUM_HOST');
        $capabilities = DesiredCapabilities::firefox();

        $firefoxOptions = new FirefoxOptions();
        $firefoxOptions->setPreference("pdfjs.disabled", "True");
        $firefoxOptions->setPreference("browser.download.folderList", 2);
        $firefoxOptions->setPreference("browser.download.manager.useWindow", False);
        $firefoxOptions->setPreference("browser.download.dir", '/home/seluser/Downloads');
        $firefoxOptions->setPreference("browser.helperApps.neverAsk.saveToDisk", "application/pdf, application/force-download");

        $firefoxOptions->addArguments(['-headless']);
        $firefoxOptions->addArguments(['window-size=2560,1440']);
        $capabilities->setCapability(FirefoxOptions::CAPABILITY, $firefoxOptions);
        /** @var RemoteWebDriver $driver */
        $driver = RemoteWebDriver::create($host, $capabilities,30000, 30000);
        $driver->manage()->window()->maximize();
        $dimension = new WebDriverDimension('2560', '1440');
        $driver->manage()->window()->setSize($dimension);
        return $driver;
    }
}
