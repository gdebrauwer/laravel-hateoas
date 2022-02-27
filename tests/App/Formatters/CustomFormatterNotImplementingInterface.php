<?php

namespace GDebrauwer\Hateoas\Tests\App\Formatters;

use GDebrauwer\Hateoas\LinkCollection;

class CustomFormatterNotImplementingInterface
{
    public function format(LinkCollection $links) : array
    {
        return [];
    }
}
