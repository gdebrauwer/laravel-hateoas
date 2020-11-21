<?php

namespace GDebrauwer\Hateoas\Formatters;

use GDebrauwer\Hateoas\LinkCollection;

class DefaultFormatter implements Formatter
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
        return $links->map(function ($link) {
            return [
                'rel' => $link->name(),
                'type' => $link->method(),
                'href' => $link->url(),
            ];
        })->toArray();
    }
}
