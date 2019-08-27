<?php

namespace GDebrauwer\Hateoas\Traits;

use GDebrauwer\Hateoas\Hateoas;

trait HasLinks
{
    /**
     * Generate JSON based on the (provided) HATEOAS class.
     *
     * @param string $class
     * @param array $arguments
     *
     * @return array
     */
    public function links(string $class = null, $arguments = [])
    {
        return Hateoas::generate(
            $class ?? get_class($this->resource),
            array_merge([$this->resource], $arguments)
        );
    }
}
