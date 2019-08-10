<?php

namespace GDebrauwer\Hateoas\Tests;

use Orchestra\Testbench\TestCase;
use GDebrauwer\Hateoas\HateoasManager;

class HateaosServiceProviderTest extends TestCase
{
    /** @test */
    public function it_registers_singleton_for_hateaos_manager()
    {
        $this->assertInstanceOf(HateoasManager::class, app('hateoas'));
    }
}
