<?php

namespace GDebrauwer\Hateoas\Traits;

use GDebrauwer\Hateoas\Hateoas;

trait HasLinks
{
    public function links(array | string | null $class = null, array $arguments = []) : array
    {
        if (is_array($class)) {
            $arguments = $class;
            $class = null;
        }

        return Hateoas::generate(
            $class ?? get_class($this->resource),
            array_merge([$this->resource], $arguments)
        );
    }
}
