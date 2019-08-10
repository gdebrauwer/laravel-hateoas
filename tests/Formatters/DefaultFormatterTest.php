<?php

namespace GDebrauwer\Hateoas\Tests;

use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Tests\TestCase;
use GDebrauwer\Hateoas\Formatters\DefaultFormatter;

class DefaultFormatterTest extends TestCase
{
    /**
     * @var \GDebrauwer\Hateoas\Link
     */
    public $link;

    /**
     * @var \GDebrauwer\Hateoas\Formatters\DefaultFormatter
     */
    public $formatter;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->link = Link::make('message.show', ['message' => 1]);
        $this->formatter = new DefaultFormatter();
    }

    /** @test */
    public function it_returns_an_array()
    {
        $this->assertIsArray($this->formatter->format($this->link));
    }

    /** @test */
    public function it_returns_an_array_with_rel_key_containing_name_of_link()
    {
        $result = $this->formatter->format($this->link);

        $this->assertArrayHasKey('rel', $result);
        $this->assertEquals($this->link->name(), $result['rel']);
    }

    /** @test */
    public function it_returns_an_array_with_type_key_containing_http_method_of_link()
    {
        $result = $this->formatter->format($this->link);

        $this->assertArrayHasKey('type', $result);
        $this->assertEquals($this->link->method(), $result['type']);
    }

    /** @test */
    public function it_returns_an_array_with_href_key_containing_url_of_link()
    {
        $result = $this->formatter->format($this->link);

        $this->assertArrayHasKey('href', $result);
        $this->assertEquals($this->link->url(), $result['href']);
    }
}
