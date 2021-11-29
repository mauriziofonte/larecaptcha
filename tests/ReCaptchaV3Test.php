<?php

/**
 * Copyright (c) 2017 - present
 * LaravelGoogleRecaptcha - ReCaptchaV3Test.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 22/1/2019
 * MIT license: https://github.com/biscolab/laravel-recaptcha/blob/master/LICENSE
 */

namespace Mfonte\ReCaptcha\Tests;

use Mfonte\ReCaptcha\Controllers\ReCaptchaController;
use Mfonte\ReCaptcha\Facades\ReCaptcha;
use Mfonte\ReCaptcha\ReCaptchaBuilderV3;
use Illuminate\Support\Facades\App;

/**
 * Class ReCaptchaV3Test
 * @package Mfonte\ReCaptcha\Tests
 */
class ReCaptchaV3Test extends TestCase
{

    protected $recaptcha_v3 = null;

    /**
     * @test
     */
    public function testGetApiVersion()
    {

        $this->assertEquals($this->recaptcha_v3->getVersion(), 'v3');
    }

    /**
     * @test
     */
    public function testAction()
    {

        $r = $this->recaptcha_v3->htmlScriptTagJsApi(['action' => 'someAction']);
        $this->assertMatchesRegularExpression('/someAction/', $r);
    }

    /**
     * @test
     */
    public function testFetchCallbackFunction()
    {

        $r = $this->recaptcha_v3->htmlScriptTagJsApi(['callback_then' => 'functionCallbackThen']);
        $this->assertMatchesRegularExpression('/functionCallbackThen\(response\)/', $r);
    }

    /**
     * @test
     */
    public function testcCatchCallbackFunction()
    {

        $r = $this->recaptcha_v3->htmlScriptTagJsApi(['callback_catch' => 'functionCallbackCatch']);
        $this->assertMatchesRegularExpression('/functionCallbackCatch\(err\)/', $r);
    }

    /**
     * @test
     */
    public function testCustomValidationFunction()
    {

        $r = $this->recaptcha_v3->htmlScriptTagJsApi(['custom_validation' => 'functionCustomValidation']);
        $this->assertMatchesRegularExpression('/functionCustomValidation\(token\)/', $r);
    }

    /**
     * @test
     */
    public function testValidateController()
    {

        $controller = App::make(ReCaptchaController::class);
        $return = $controller->validateV3();

        $this->assertArrayHasKey("success", $return);
        $this->assertArrayHasKey("error-codes", $return);
    }

    /**
     * @test
     */
    public function testCurlTimeoutIsSet()
    {

        $this->assertEquals($this->recaptcha_v3->getCurlTimeout(), 3);
    }

    /**
     * @test
     */
    public function testHtmlScriptTagJsApiCalledByFacade()
    {

        ReCaptcha::shouldReceive('htmlScriptTagJsApi')
            ->once()
            ->with([]);

        htmlScriptTagJsApi([]);
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {

        $app['config']->set('recaptcha.version', 'v3');
        $app['config']->set('recaptcha.curl_timeout', 3);
    }

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {

        parent::setUp(); // TODO: Change the autogenerated stub

        $this->recaptcha_v3 = new ReCaptchaBuilderV3('api_site_key', 'api_secret_key');
    }
}