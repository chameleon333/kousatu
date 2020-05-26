<?php

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\TestCase as BaseTestCase;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */

    protected function baseUrl()
    {
        // return 'http://nginx';
        // return 'http://localhost';
        // dd(config('app.base_url'));
        return config('app.base_url');
    }

    public static function prepare()
    {
        // static::startChromeDriver();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments([
            '--disable-gpu',
            '--headless',
            '--window-size=1920,1080',
        ]);
        // dd();
        return RemoteWebDriver::create(
            // 'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
            // 'http://localhost:4444/wd/hub', DesiredCapabilities::chrome()->setCapability(
            // 'http://selenium:4444/wd/hub', DesiredCapabilities::chrome()->setCapability(
                config('app.remote_webdriver_url'), DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }
}
