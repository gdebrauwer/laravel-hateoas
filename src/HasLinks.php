<?php

namespace GDebrauwer\Hateoas;

use GDebrauwer\Hateoas\Hateoas;

trait HasLinks
{
    /**
     * Generate JSON based on the (provided) HATEOAS class.
     *
     * @param string $class
     * @param array $arguments
     *
     * @return void
     */
    public function links(string $class = null, $arguments = [])
    {
        if ($class === null) {
            $class = Hateoas::guessHateoasClassName(get_class($this->resource));
        }

        return Hateoas::generate($class, array_merge([$this->resource], $arguments));
    }
}
