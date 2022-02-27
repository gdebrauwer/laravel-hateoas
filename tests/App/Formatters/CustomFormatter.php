<?php

namespace GDebrauwer\Hateoas\Tests\App\Formatters;

use GDebrauwer\Hateoas\Formatters\Formatter;
use GDebrauwer\Hateoas\LinkCollection;

class CustomFormatter implements Formatter
{
    public function format(LinkCollection $links) : array
    {
        return [];
    }
}
