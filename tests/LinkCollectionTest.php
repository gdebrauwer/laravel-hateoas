<?php

namespace GDebrauwer\Hateoas\Tests;

use GDebrauwer\Hateoas\LinkCollection;
use GDebrauwer\Hateoas\Formatters\Formatter;

class LinkCollectionTest extends TestCase
{
    /** @test */
    public function it_can_format_links_using_the_class_binded_to_formatter_interface()
    {
        $links = new LinkCollection();

        $this->mock('\GDebrauwer\Hateoas\Tests\App\TestFormatter', function ($mock) use ($links) {
            $mock->shouldReceive('format')->once()->with($links)->andReturn(['key' => 'value']);
        });

        $this->app->bind(Formatter::class, '\GDebrauwer\Hateoas\Tests\App\TestFormatter');

        $this->assertEquals(['key' => 'value'], $links->format());
    }
}
