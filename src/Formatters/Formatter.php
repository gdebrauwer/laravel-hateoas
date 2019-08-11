<?php

namespace GDebrauwer\Hateoas\Formatters;

use GDebrauwer\Hateoas\LinkCollection;

interface Formatter
{
    /**
     * Format the links to the desired JSON format.
     *
     * @param \GDebrauwer\Hateoas\LinkCollection $links
     *
     * @return array
     */
    public function format(LinkCollection $links);
}
