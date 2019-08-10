<?php

namespace GDebrauwer\Hateoas\Formatters;

use GDebrauwer\Hateoas\Link;

class DefaultFormatter implements Formatter
{
    /**
     * Format a link to JSON format.
     *
     * @param \GDebrauwer\Hateoas\Link $link
     *
     * @return array
     */
    public function format(Link $link)
    {
        return [
            'rel' => $link->name(),
            'type' => $link->method(),
            'href' => $link->url(),
        ];
    }
}
