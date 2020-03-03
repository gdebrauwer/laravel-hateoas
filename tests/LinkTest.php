<?php

namespace GDebrauwer\Hateoas\Tests;

use GDebrauwer\Hateoas\Exceptions\LinkException;
use GDebrauwer\Hateoas\Link;

class LinkTest extends TestCase
{
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
    public function it_throws_link_exception_if_it_can_not_find_route_by_name_when_trying_to_get_http_method_of_route()
    {
        $link = (new Link('random.route'))->as('randomlink');

        $this->expectException(LinkException::class);
        $this->expectExceptionMessage("Link with name `{$link->name()}` could not be created because route with name `{$link->routeName()}` could not be found");

        $link->method();
    }

    /** @test */
    public function it_can_get_the_path_of_the_route()
    {
        $link = new Link('message.show', ['message' => 1]);

        $this->assertEquals('/message/1', $link->path());
    }

    /** @test */
    public function it_throws_link_exception_if_it_can_not_find_route_by_name_when_trying_to_get_path_of_route()
    {
        $link = (new Link('random.route'))->as('randomlink');

        $this->expectException(LinkException::class);
        $this->expectExceptionMessage("Link with name `{$link->name()}` could not be created because route with name `{$link->routeName()}` could not be found");

        $link->path();
    }

    /** @test */
    public function it_throws_link_exception_if_it_misses_route_parameters_when_trying_to_get_path_of_route()
    {
        $link = (new Link('message.show'))->as('self');

        $this->expectException(LinkException::class);
        $this->expectExceptionMessage("Link with name `{$link->name()}` could not be created because not all parameters for route with name `{$link->routeName()}` were provided");

        $link->path();
    }

    /** @test */
    public function it_can_get_the_full_url_of_the_route()
    {
        $link = new Link('message.show', ['message' => 1]);

        $this->assertEquals('http://localhost/message/1', $link->url());
    }

    /** @test */
    public function it_throws_link_exception_if_it_can_not_find_route_by_name_when_trying_to_get_full_url_of_route()
    {
        $link = (new Link('random.route'))->as('randomlink');

        $this->expectException(LinkException::class);
        $this->expectExceptionMessage("Link with name `{$link->name()}` could not be created because route with name `{$link->routeName()}` could not be found");

        $link->url();
    }

    /** @test */
    public function it_throws_link_exception_if_it_misses_route_parameters_when_trying_to_get_full_url_of_route()
    {
        $link = (new Link('message.show'))->as('self');

        $this->expectException(LinkException::class);
        $this->expectExceptionMessage("Link with name `{$link->name()}` could not be created because not all parameters for route with name `{$link->routeName()}` were provided");

        $link->url();
    }

    /** @test */
    public function it_can_get_the_route_name()
    {
        $link = new Link('message.show', ['message' => 1]);

        $this->assertEquals('message.show', $link->routeName());
    }
}
