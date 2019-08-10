<?php

namespace GDebrauwer\Hateoas;

use Illuminate\Support\Facades\Facade;

/**
 * @see \GDebrauwer\Hateoas\Hateoas
 */
class Hateoas extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'hateoas';
    }
}
