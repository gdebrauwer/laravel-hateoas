<?php

namespace GDebrauwer\LaravelHateoas;

use Illuminate\Support\Facades\Facade;

/**
 * @see \GDebrauwer\LaravelHateoas\Skeleton\SkeletonClass
 */
class LaravelHateoasFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-hateoas';
    }
}
