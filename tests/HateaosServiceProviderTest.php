<?php

namespace GDebrauwer\Hateoas\Tests;

use GDebrauwer\Hateoas\HateoasManager;
use GDebrauwer\Hateoas\Formatters\Formatter;
use GDebrauwer\Hateoas\Formatters\DefaultFormatter;

class HateaosServiceProviderTest extends TestCase
{
    /** @test */
    public function it_registers_singleton_for_hateaos_manager()
    {
        $this->assertInstanceOf(HateoasManager::class, app('hateoas'));
    }

    /** @test */
    public function it_binds_formatter_interface_to_default_formatter_class()
    {
        $this->assertInstanceOf(DefaultFormatter::class, app(Formatter::class));
    }
}
