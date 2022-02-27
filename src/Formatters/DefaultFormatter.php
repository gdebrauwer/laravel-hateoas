<?php

namespace GDebrauwer\Hateoas\Formatters;

use GDebrauwer\Hateoas\LinkCollection;

class DefaultFormatter implements Formatter
{
    public function format(LinkCollection $links) : array
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
