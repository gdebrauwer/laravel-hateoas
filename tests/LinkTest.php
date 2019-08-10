<?php

namespace GDebrauwer\Hateoas\Tests;

use GDebrauwer\Hateoas\Link;
use Orchestra\Testbench\TestCase;
use GDebrauwer\Hateoas\HateoasServiceProvider;
use GDebrauwer\Hateoas\Tests\App\Providers\RouteServiceProvider;

class LinkTest extends TestCase
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

    /** @test */
    public function it_can_be_created_using_static_method()
    {
        $this->assertInstanceOf(Link::class, Link::make('message.show', ['message' => 1]));
    }

    /** @test */
    public function it_uses_the_route_name_as_name_by_default()
    {
        $link = new Link('message.show', ['message' => 1]);

        $this->assertEquals('message.show', $link->name());
    }

    /** @test */
    public function it_can_be_given_a_name()
    {
        $link = new Link('message.show', ['message' => 1]);
        $link->as('random_name');

        $this->assertEquals('random_name', $link->name());
    }

    /** @test */
    public function it_can_get_the_http_method_of_the_route()
    {
        $postRouteLink = new Link('message.store');
        $getRouteLink = new Link('message.show', ['message' => 1]);
        $putRouteLink = new Link('message.update', ['message' => 1]);
        $deleteRouteLink = new Link('message.destroy', ['message' => 1]);

        $this->assertEquals('POST', $postRouteLink->method());
        $this->assertEquals('GET', $getRouteLink->method());
        $this->assertEquals('PUT', $putRouteLink->method());
        $this->assertEquals('DELETE', $deleteRouteLink->method());
    }

    /** @test */
    public function it_can_get_the_path_of_the_route()
    {
        $link = new Link('message.show', ['message' => 1]);

        $this->assertEquals('/message/1', $link->path());
    }

    /** @test */
    public function it_can_get_the_full_url_of_the_route()
    {
        $link = new Link('message.show', ['message' => 1]);

        $this->assertEquals('http://localhost/message/1', $link->URL());
    }
}
