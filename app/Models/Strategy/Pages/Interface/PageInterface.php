<?php

namespace App\Models\Strategy\Pages\Interface;

use Facebook\WebDriver\Remote\RemoteWebDriver;

interface PageInterface
{
    public function resolve(RemoteWebDriver $driver): void;
}
