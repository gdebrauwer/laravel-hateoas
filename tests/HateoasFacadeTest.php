<?php

namespace GDebrauwer\Hateoas\Tests;

use GDebrauwer\Hateoas\Hateoas;
use GDebrauwer\Hateoas\HateoasManager;

class HateoasFacadeTest extends TestCase
{
    /** @test */
    public function it_returns_an_hateaos_manager_instance()
    {
        $this->assertInstanceOf(HateoasManager::class, Hateoas::getFacadeRoot());
    }
}
