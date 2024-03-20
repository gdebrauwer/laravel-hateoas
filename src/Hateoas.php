<?php

namespace GDebrauwer\Hateoas;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array generate(string $class, $arguments = [])
 * @method static \GDebrauwer\Hateoas\HateoasManager guessHateoasClassNameUsing(callable $callback)
 * @method static \GDebrauwer\Hateoas\HateoasManager formatLinksUsing(callable $callback)
 *
 * @see \GDebrauwer\Hateoas\HateoasManager
 */
class Hateoas extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'hateoas';
    }
}
