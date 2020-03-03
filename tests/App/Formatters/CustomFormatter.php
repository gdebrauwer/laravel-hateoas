<?php

namespace GDebrauwer\Hateoas\Tests\App\Formatters;

use GDebrauwer\Hateoas\Formatters\Formatter;
use GDebrauwer\Hateoas\LinkCollection;

class CustomFormatter implements Formatter
{
    /**
     * Format the links to the desired JSON format.
     *
     * @param \GDebrauwer\Hateoas\LinkCollection $links
     *
     * @return array
     */
    public function format(LinkCollection $links)
    {
        return [];
    }
}
