<?php
/**
 * Copyright (c) 2017 - present
 * LaravelGoogleRecaptcha - TestCase.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 12/9/2018
 * MIT license: https://github.com/biscolab/laravel-recaptcha/blob/master/LICENSE
 */

namespace Mfonte\ReCaptcha\Tests;

use Mfonte\ReCaptcha\Facades\ReCaptcha;
use Mfonte\ReCaptcha\ReCaptchaServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

/**
 * Class TestCase
 * @package Mfonte\ReCaptcha\Tests
 */
class TestCase extends OrchestraTestCase
{

	/**
	 * Load package alias
	 *
	 * @param  \Illuminate\Foundation\Application $app
	 *
	 * @return array
	 */
	protected function getPackageAliases($app)
	{

		return [
			'ReCaptcha' => ReCaptcha::class,
		];
	}

	/**
	 * Load package service provider
	 *
	 * @param \Illuminate\Foundation\Application $app
	 *
	 * @return array
	 */
	protected function getPackageProviders($app)
	{

		return [ReCaptchaServiceProvider::class];
	}
}
