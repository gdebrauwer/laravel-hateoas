<?php

namespace GDebrauwer\Hateoas\Tests;

use GDebrauwer\Hateoas\Formatters\DefaultFormatter;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\LinkCollection;

class DefaultFormatterTest extends TestCase
{
    /**
     * @var \GDebrauwer\Hateoas\LinkCollection
     */
    public $links;

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

        $this->links = LinkCollection::make([
            Link::make('message.show', ['message' => 1]),
            Link::make('message.reply', ['message' => 1]),
        ]);

        $this->formatter = new DefaultFormatter();
    }

    /** @test */
    public function it_returns_an_array_containing_arrays()
    {
        $result = $this->formatter->format($this->links);

        $this->assertIsArray($result);

        foreach ($result as $item) {
            $this->assertIsArray($item);
        }
    }

    /** @test */
    public function it_returns_array_of_arrays_that_each_have_rel_key_containing_name_of_their_link()
    {
        $result = $this->formatter->format($this->links);

        $this->assertArrayHasKey('rel', $result[0]);
        $this->assertArrayHasKey('rel', $result[1]);

        $this->assertEquals($this->links[0]->name(), $result[0]['rel']);
        $this->assertEquals($this->links[1]->name(), $result[1]['rel']);
    }

    /** @test */
    public function it_returns_array_of_arrays_that_each_have_type_key_containing_http_method_of_their_link()
    {
        $result = $this->formatter->format($this->links);

        $this->assertArrayHasKey('type', $result[0]);
        $this->assertArrayHasKey('type', $result[1]);

        $this->assertEquals($this->links[0]->method(), $result[0]['type']);
        $this->assertEquals($this->links[1]->method(), $result[1]['type']);
    }

    /** @test */
    public function it_returns_an_array_with_href_key_containing_url_of_link()
    {
        $result = $this->formatter->format($this->links);

        $this->assertArrayHasKey('href', $result[0]);
        $this->assertArrayHasKey('href', $result[1]);

        $this->assertEquals($this->links[0]->url(), $result[0]['href']);
        $this->assertEquals($this->links[1]->url(), $result[1]['href']);
    }
}
