<?php

namespace GDebrauwer\Hateoas\Tests;

use GDebrauwer\Hateoas\Hateoas;
use GDebrauwer\Hateoas\HateoasManager;
use PHPUnit\Framework\Attributes\Test;

class HateoasFacadeTest extends TestCase
{
    #[Test]
    /** @test */
    public function it_returns_an_hateaos_manager_instance()
    {
        $this->assertInstanceOf(HateoasManager::class, Hateoas::getFacadeRoot());
    }
}
