<?php

namespace GDebrauwer\Hateoas\Traits;

use GDebrauwer\Hateoas\Link;

trait CreatesLinks
{
    protected function link(...$arguments) : Link
    {
        return Link::make(...$arguments);
    }
}
