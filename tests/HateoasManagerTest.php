<?php

namespace GDebrauwer\Hateoas\Tests;

use GDebrauwer\Hateoas\HateoasManager;
use GDebrauwer\Hateoas\Tests\App\Message;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoas;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoasReturningNoLinks;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoasReturningNonLinks;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoasReturningNotAllLinks;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoasWithNonSnakeCaseMethods;
use GDebrauwer\Hateoas\Tests\App\Hateoas\MessageHateoasWithSpecificNamedLink;

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
    }

    /** @test */
    public function it_generates_an_array_of_formatted_links()
    {
        $result = $this->manager->generate(MessageHateoas::class, [Message::make(['id' => 1])]);

        $expectedResult = [
            [
                'rel' => 'self',
                'type' => 'GET',
                'href' => 'http://localhost/message/1'
            ],
            [
                'rel' => 'reply',
                'type' => 'PUT',
                'href' => 'http://localhost/message/1/reply'
            ],
            [
                'rel' => 'delete',
                'type' => 'DELETE',
                'href' => 'http://localhost/message/1'
            ]
        ];

        $this->assertEquals($expectedResult, $result);
    }

    /** @test */
    public function it_generates_an_empty_array_if_no_methods_of_hateoas_class_return_links()
    {
        $result = $this->manager->generate(MessageHateoasReturningNoLinks::class, [Message::make(['id' => 1])]);

        $this->assertEquals([], $result);
    }

    /** @test */
    public function it_generates_an_array_ignoring_nullable_results_of_methods_of_hateoas_class()
    {
        $result = $this->manager->generate(MessageHateoasReturningNotAllLinks::class, [Message::make(['id' => 1])]);

        $expectedResult = [
            [
                'rel' => 'self',
                'type' => 'GET',
                'href' => 'http://localhost/message/1'
            ],
            [
                'rel' => 'reply',
                'type' => 'PUT',
                'href' => 'http://localhost/message/1/reply'
            ],
        ];

        $this->assertEquals($expectedResult, $result);
    }

    /** @test */
    public function it_generates_an_array_ignoring_non_link_results_of_methods_of_hateoas_class()
    {
        $result = $this->manager->generate(MessageHateoasReturningNonLinks::class, [Message::make(['id' => 1])]);

        $expectedResult = [
            [
                'rel' => 'self',
                'type' => 'GET',
                'href' => 'http://localhost/message/1'
            ],
        ];

        $this->assertEquals($expectedResult, $result);
    }

    /** @test */
    public function it_generates_an_array_with_snake_case_method_names_of_hateoas_class_as_link_names()
    {
        $result = $this->manager->generate(MessageHateoasWithNonSnakeCaseMethods::class, [Message::make(['id' => 1])]);

        $expectedResult = [
            [
                'rel' => 'self',
                'type' => 'GET',
                'href' => 'http://localhost/message/1'
            ],
            [
                'rel' => 'remove_from_thread',
                'type' => 'DELETE',
                'href' => 'http://localhost/message/1'
            ],
        ];

        $this->assertEquals($expectedResult, $result);
    }

    /** @test */
    public function it_generates_an_array_with_custom_method_names_of_hateoas_class_if_specified()
    {
        $result = $this->manager->generate(MessageHateoasWithSpecificNamedLink::class, [Message::make(['id' => 1])]);

        $expectedResult = [
            [
                'rel' => 'self',
                'type' => 'GET',
                'href' => 'http://localhost/message/1'
            ],
            [
                'rel' => 'removeFromThread',
                'type' => 'DELETE',
                'href' => 'http://localhost/message/1'
            ],
        ];

        $this->assertEquals($expectedResult, $result);
    }
}
