<?php

/**
 * Copyright (c) 2017 - present
 * LaravelGoogleRecaptcha - ReCaptchaCustomApiDomainTest.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 13/9/2020
 * MIT license: https://github.com/biscolab/laravel-recaptcha/blob/master/LICENSE
 */

namespace Mfonte\ReCaptcha\Tests;

use Mfonte\ReCaptcha\ReCaptchaBuilderInvisible;
use Mfonte\ReCaptcha\ReCaptchaBuilderV2;
use Mfonte\ReCaptcha\ReCaptchaBuilderV3;

class ReCaptchaCustomApiDomainTest extends TestCase
{

    /**
     * @var ReCaptchaBuilderInvisible
     */
    protected $recaptcha_invisible;

    /**
     * @var ReCaptchaBuilderV2
     */
    protected $recaptcha_v2;

    /**
     * @var ReCaptchaBuilderV3
     */
    protected $recaptcha_v3;

    /**
     * @test
     */
    public function testRecaptchaApiDomainChangesByConfig()
    {
        $this->app['config']->set('recaptcha.api_domain', 'www.recaptcha.net');
        $this->assertEquals("www.recaptcha.net", $this->recaptcha_v2->getApiDomain());
        $this->assertEquals("www.recaptcha.net", $this->recaptcha_invisible->getApiDomain());
        $this->assertEquals("www.recaptcha.net", $this->recaptcha_v3->getApiDomain());
    }

    /**
     * @test
     */
    public function testRecaptchaApiDomainChangesByConfigInHtmlScriptTagJsApi()
    {
        $this->assertStringContainsString("https://www.recaptcha.net/recaptcha/api.js", $this->recaptcha_v2->htmlScriptTagJsApi());
        $this->assertStringContainsString("https://www.recaptcha.net/recaptcha/api.js", $this->recaptcha_invisible->htmlScriptTagJsApi());
        $this->assertStringContainsString("https://www.recaptcha.net/recaptcha/api.js", $this->recaptcha_v3->htmlScriptTagJsApi());
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

        $app['config']->set('recaptcha.api_domain', 'www.recaptcha.net');
    }

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {

        parent::setUp(); // TODO: Change the autogenerated stub
        $this->recaptcha_invisible = new ReCaptchaBuilderInvisible('api_site_key', 'api_secret_key');
        $this->recaptcha_v2 = new ReCaptchaBuilderV2('api_site_key', 'api_secret_key');
        $this->recaptcha_v3 = new ReCaptchaBuilderV3('api_site_key', 'api_secret_key');
    }
}
