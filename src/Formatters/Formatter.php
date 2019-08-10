<?php

namespace GDebrauwer\Hateoas\Formatters;

use GDebrauwer\Hateoas\Link;

interface Formatter
{
    /**
     * Format a link to JSON format.
     *
     * @param \GDebrauwer\Hateoas\Link $link
     *
     * @return array
     */
    public function format(Link $link);
}
