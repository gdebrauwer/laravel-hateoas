<?php

namespace GDebrauwer\Hateoas\Traits;

use GDebrauwer\Hateoas\Link;

trait CreatesLinks
{
    /**
     * Create a new link.
     *
     * @param array $arguments
     *
     * @return \GDebrauwer\Hateoas\Link
     */
    protected function link(...$arguments)
    {
        return Link::make(...$arguments);
    }
}
