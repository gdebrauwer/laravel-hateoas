<?php

namespace GDebrauwer\Hateoas\Tests;

use GDebrauwer\Hateoas\Tests\App\Message;
use GDebrauwer\Hateoas\Tests\App\Resources\MessageResource;
use GDebrauwer\Hateoas\Hateoas;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoas;
use GDebrauwer\Hateoas\Tests\App\Resources\MessageResourceWithExtraArguments;
use GDebrauwer\Hateoas\Tests\App\Resources\MessageResourceWithExplicitHateoasClass;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoasReturningNoLinks;

class HasLinksTest extends TestCase
{
    /**
     * @var \GDebrauwer\Hateoas\Tests\App\Message
     */
    public $message;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->message = Message::make(['id' => 123, 'text' => 'Hello world!']);
    }

    /** @test */
    public function it_calls_hateaos_generate_method_using_resource_hateoas_class()
    {
        Hateoas::shouldReceive('guessHateoasClassName')
            ->once()
            ->with(Message::class)
            ->andReturn(MessageHateoas::class);

        Hateoas::shouldReceive('generate')
            ->once()
            ->with(MessageHateoas::class, [$this->message])
            ->andReturn([]);

        (new MessageResource($this->message))->toArray(null);
    }

    /** @test */
    public function it_calls_hateaos_generate_method_with_extra_arguments()
    {
        Hateoas::shouldReceive('guessHateoasClassName')
            ->once()
            ->with(Message::class)
            ->andReturn(MessageHateoas::class);

        Hateoas::shouldReceive('generate')
            ->once()
            ->with(MessageHateoas::class, [$this->message, 'abc', 123])
            ->andReturn([]);

        (new MessageResourceWithExtraArguments($this->message))->toArray(null);
    }

    /** @test */
    public function it_calls_hateaos_generate_method_with_explicitly_provided_class()
    {
        Hateoas::shouldReceive('generate')
            ->once()
            ->with(MessageHateoasReturningNoLinks::class, [$this->message])
            ->andReturn([]);

        (new MessageResourceWithExplicitHateoasClass($this->message))->toArray(null);
    }
}
