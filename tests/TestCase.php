<?php

namespace GDebrauwer\Hateoas\Tests;

use GDebrauwer\Hateoas\HateoasServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use GDebrauwer\Hateoas\Tests\App\Providers\RouteServiceProvider;

class TestCase extends BaseTestCase
{
    /**
     * Register package providers.
     *
     * @param mixed $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            HateoasServiceProvider::class,
            RouteServiceProvider::class,
        ];
    }

}
