<?php

namespace GDebrauwer\Hateoas\Tests\App\Formatters;

use GDebrauwer\Hateoas\LinkCollection;

class CustomFormatterNotImplementingInterface
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
