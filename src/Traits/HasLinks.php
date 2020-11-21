<?php

namespace GDebrauwer\Hateoas\Traits;

use GDebrauwer\Hateoas\Hateoas;

trait HasLinks
{
    /**
     * Generate JSON based on the (provided) HATEOAS class.
     *
     * @param null|array|string $class
     * @param array $arguments
     *
     * @return array
     */
    public function links($class = null, $arguments = [])
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
