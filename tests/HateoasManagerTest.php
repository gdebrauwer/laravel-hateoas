<?php

namespace GDebrauwer\Hateoas\Tests;

use GDebrauwer\Hateoas\Formatters\CallbackFormatter;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\HateoasManager;
use GDebrauwer\Hateoas\Tests\App\Message;
use GDebrauwer\Hateoas\Formatters\Formatter;
use GDebrauwer\Hateoas\Formatters\DefaultFormatter;
use GDebrauwer\Hateoas\LinkCollection;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoas;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoasReturningNoLinks;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoasReturningNonLinks;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoasWithExtraParameters;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoasReturningNotAllLinks;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoasWithSpecificNamedLink;
use GDebrauwer\Hateoas\Tests\App\Hateoas\CustomGuess\CustomGuessMessageHateoas;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoasWithNonSnakeCaseMethods;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoasThatResultsInAnException;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoasWithConstructorDependencyInjection;

class HateoasManagerTest extends TestCase
{
    /**
     * @var \GDebrauwer\Hateoas\HateoasManager
     */
    public $manager;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->manager = new HateoasManager();

        $this->app->bind(Formatter::class, DefaultFormatter::class);
    }

    /**
     * Check if the provided link is the same as the expected link.
     *
     * @param \GDebrauwer\Hateoas\Link $link
     *
     * @return bool
     */
    public function assertEqualLinks(Link $expectedLink, Link $actualLink)
    {
        $this->assertEquals(
            $expectedLink->name(),
            $actualLink->name(),
            'Failed asserting that link equals expected link (names do not match)'
        );

        $this->assertEquals(
            $expectedLink->method(),
            $actualLink->method(),
            'Failed asserting that link equals expected link (HTTP methods do not match)'
        );

        $this->assertEquals(
            $expectedLink->url(),
            $actualLink->url(),
            'Failed asserting that link equals expected link (URL do not match)'
        );

        return true;
    }

    /** @test */
    public function it_generates_a_link_collection()
    {
        $this->mock(DefaultFormatter::class, function ($mock) {
            $mock->shouldReceive('format')
                ->once()
                ->withArgs(function ($links) {
                    return $links->count() === 3
                        && $this->assertEqualLinks(Link::make('message.show', ['message' => 1])->as('self'), $links[0])
                        && $this->assertEqualLinks(Link::make('message.reply', ['message' => 1])->as('reply'), $links[1])
                        && $this->assertEqualLinks(Link::make('message.destroy', ['message' => 1])->as('delete'), $links[2]);
                })
                ->andReturn([]);
        });

        $this->assertEquals([], $this->manager->generate(MessageHateoas::class, [Message::make(['id' => 1])]));
    }

    /** @test */
    public function it_generates_an_empty_link_collection_if_no_methods_of_hateoas_class_return_links()
    {
        $this->mock(DefaultFormatter::class, function ($mock) {
            $mock->shouldReceive('format')
                ->once()
                ->withArgs(function ($links) {
                    return $links->count() === 0;
                })
                ->andReturn([]);
        });

        $this->assertEquals([], $this->manager->generate(MessageHateoasReturningNoLinks::class, [Message::make(['id' => 1])]));
    }

    /** @test */
    public function it_generates_an_empty_link_collection_if_the_hateoas_class_does_not_exist()
    {
        $this->mock(DefaultFormatter::class, function ($mock) {
            $mock->shouldReceive('format')
                ->once()
                ->withArgs(function ($links) {
                    return $links->count() === 0;
                })
                ->andReturn([]);
        });

        $this->assertEquals([], $this->manager->generate(MessageHateoasThatDoesNotExist::class, [Message::make(['id' => 1])]));
    }

    /** @test */
    public function it_generates_an_empty_link_collection_if_a_method_of_hateoas_class_throws_an_exception()
    {
        $this->mock(DefaultFormatter::class, function ($mock) {
            $mock->shouldReceive('format')
                ->once()
                ->withArgs(function ($links) {
                    return $links->count() === 0;
                })
                ->andReturn([]);
        });

        $this->assertEquals([], $this->manager->generate(MessageHateoasThatResultsInAnException::class, [Message::make(['id' => 1])]));
    }

    /** @test */
    public function it_generates_a_link_collection_without_nullable_results_of_methods_of_hateoas_class()
    {
        $this->mock(DefaultFormatter::class, function ($mock) {
            $mock->shouldReceive('format')
                ->once()
                ->withArgs(function ($links) {
                    return $links->count() === 2
                        && $this->assertEqualLinks(Link::make('message.show', ['message' => 1])->as('self'), $links[0])
                        && $this->assertEqualLinks(Link::make('message.reply', ['message' => 1])->as('reply'), $links[1]);
                })
                ->andReturn([]);
        });

        $this->assertEquals([], $this->manager->generate(MessageHateoasReturningNotAllLinks::class, [Message::make(['id' => 1])]));
    }

    /** @test */
    public function it_generates_a_link_collection_without_non_link_results_of_methods_of_hateoas_class()
    {
        $this->mock(DefaultFormatter::class, function ($mock) {
            $mock->shouldReceive('format')
                ->once()
                ->withArgs(function ($links) {
                    return $links->count() === 1
                        && $this->assertEqualLinks(Link::make('message.show', ['message' => 1])->as('self'), $links[0]);
                })
                ->andReturn([]);
        });

        $this->assertEquals([], $this->manager->generate(MessageHateoasReturningNonLinks::class, [Message::make(['id' => 1])]));
    }

    /** @test */
    public function it_generates_a_link_collection_from_results_of_hateoas_class_methods_with_extra_arguments()
    {
        $this->mock(DefaultFormatter::class, function ($mock) {
            $mock->shouldReceive('format')
                ->once()
                ->withArgs(function ($links) {
                    return $links->count() === 2
                        && $this->assertEqualLinks(Link::make('message.show', ['message' => 'abc'])->as('self'), $links[0])
                        && $this->assertEqualLinks(Link::make('message.destroy', ['message' => 123])->as('delete'), $links[1]);
                })
                ->andReturn([]);
        });

        $this->assertEquals([], $this->manager->generate(MessageHateoasWithExtraParameters::class, [Message::make(['id' => 1]), 123, 'abc']));
    }

    /** @test */
    public function it_generates_a_link_collection_with_snake_case_hateoas_class_method_names_as_link_names()
    {
        $this->mock(DefaultFormatter::class, function ($mock) {
            $mock->shouldReceive('format')
                ->once()
                ->withArgs(function ($links) {
                    return $links->count() === 2
                        && $this->assertEqualLinks(Link::make('message.show', ['message' => 1])->as('self'), $links[0])
                        && $this->assertEqualLinks(Link::make('message.destroy', ['message' => 1])->as('remove_from_thread'), $links[1]);
                })
                ->andReturn([]);
        });

        $this->assertEquals([], $this->manager->generate(MessageHateoasWithNonSnakeCaseMethods::class, [Message::make(['id' => 1])]));
    }

    /** @test */
    public function it_generates_a_link_collection_where_links_can_have_custom_names_if_specified()
    {
        $this->mock(DefaultFormatter::class, function ($mock) {
            $mock->shouldReceive('format')
                ->once()
                ->withArgs(function ($links) {
                    return $links->count() === 2
                        && $this->assertEqualLinks(Link::make('message.show', ['message' => 1])->as('self'), $links[0])
                        && $this->assertEqualLinks(Link::make('message.destroy', ['message' => 1])->as('removeFromThread'), $links[1]);
                })
                ->andReturn([]);
        });

        $this->assertEquals([], $this->manager->generate(MessageHateoasWithSpecificNamedLink::class, [Message::make(['id' => 1])]));
    }

    /** @test */
    public function it_generates_a_link_collection_even_if_hateoas_class_constructor_uses_dependency_injection()
    {
        $this->mock(DefaultFormatter::class, function ($mock) {
            $mock->shouldReceive('format')
                ->once()
                ->withArgs(function ($links) {
                    return $links->count() === 1
                        && $this->assertEqualLinks(Link::make('message.show', ['message' => 1])->as('self'), $links[0]);
                })
                ->andReturn([]);
        });

        $this->assertEquals([], $this->manager->generate(MessageHateoasWithConstructorDependencyInjection::class, [Message::make(['id' => 1])]));
    }

    /** @test */
    public function it_generates_a_link_collection_and_returns_the_array_created_using_the_binded_formatter_class()
    {
        $this->mock(DefaultFormatter::class, function ($mock) {
            $mock->shouldReceive('format')
                ->once()
                ->andReturn(['key' => 'value']);
        });

        $result = $this->manager->generate(MessageHateoas::class, [Message::make(['id' => 1])]);

        $this->assertEquals(['key' => 'value'], $result);
    }

    /** @test */
    public function it_generates_a_link_collection_for_guessed_hateoas_class_based_on_provided_class()
    {
        $this->mock(DefaultFormatter::class, function ($mock) {
            $mock->shouldReceive('format')
                ->once()
                ->withArgs(function ($links) {
                    return $links->count() === 3;
                })
                ->andReturn([]);
        });

        $result = $this->manager->generate(Message::class, [Message::make(['id' => 1])]);

        $this->assertEquals([], $result);
    }

    /** @test */
    public function it_generates_a_link_collection_for_hateoas_class_guessed_with_custom_closure()
    {
        $this->manager->guessHateoasClassNameUsing(function (string $class) {
            return CustomGuessMessageHateoas::class;
        });

        $this->mock(DefaultFormatter::class, function ($mock) {
            $mock->shouldReceive('format')
                ->once()
                ->withArgs(function ($links) {
                    return $links->count() === 1
                        && $this->assertEqualLinks(Link::make('message.show', ['message' => 1])->as('customGuessSelf'), $links[0]);
                })
                ->andReturn([]);
        });

        $result = $this->manager->generate(Message::class, [Message::make(['id' => 1])]);

        $this->assertEquals([], $result);
    }

    /** @test */
    public function it_binds_a_callback_formatter_to_formatter_instance()
    {
        $this->manager->formatLinksUsing(function (LinkCollection $links) {
            return ['key' => 'value'];
        });

        $formatter = app(Formatter::class);

        $this->assertInstanceOf(CallbackFormatter::class, $formatter);
        $this->assertEquals(
            ['key' => 'value'],
            $formatter->format(new LinkCollection())
        );
    }
}
