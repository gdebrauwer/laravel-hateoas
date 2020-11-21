<?php

namespace GDebrauwer\Hateoas\Tests;

use GDebrauwer\Hateoas\Formatters\CallbackFormatter;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\LinkCollection;

class CallbackFormatterTest extends TestCase
{
    /**
     * @var \GDebrauwer\Hateoas\LinkCollection
     */
    public $links;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->links = LinkCollection::make([
            Link::make('message.show', ['message' => 1]),
            Link::make('message.reply', ['message' => 1]),
        ]);
    }

    /** @test */
    public function it_returns_an_array_formatted_using_the_callback_of_the_formatter()
    {
        $callback = function (LinkCollection $links) {
            return $links->map(function ($link) {
                return [
                    'name' => $link->name(),
                    'url' => $link->url(),
                ];
            })->toArray();
        };

        $result = (new CallbackFormatter($callback))->format($this->links);

        $this->assertEquals(
            [
                ['name' => $this->links[0]->name(), 'url' => $this->links[0]->url()],
                ['name' => $this->links[1]->name(), 'url' => $this->links[1]->url()],
            ],
            $result
        );
    }
}
