<?php

namespace GDebrauwer\Hateoas\Tests;

use Orchestra\Testbench\TestCase;
use GDebrauwer\Hateoas\HateoasManager;
use GDebrauwer\Hateoas\Hateoas;

class HateoasFacadeTest extends TestCase
{
    /** @test */
    public function it_returns_an_hateaos_manager_instance()
    {
        $this->assertInstanceOf(HateoasManager::class, Hateoas::getFacadeRoot());
    }
}
