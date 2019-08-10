<?php

namespace GDebrauwer\Hateoas;

use Illuminate\Support\Str;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Formatters\Formatter;

class HateoasManager
{
    /**
     * Generate HATEOAS links from the provided class and transform the data to JSON.
     *
     * @param string $class
     * @param array $arguments
     *
     * @return array
     */
    public function generate(string $class, $arguments = [])
    {
        return $this->links($class, $arguments)
            ->map(function ($link) {
                return app(Formatter::class)->format($link);
            })
            ->toArray();
    }

    /**
     * Get links from a HATEOAS class.
     *
     * @param string $class
     * @param array $arguments
     *
     * @return \Illuminate\Support\Collection
     */
    protected function links(string $class, $arguments = [])
    {
        return collect(get_class_methods($class))
            ->map(function ($method) use ($class, $arguments) {
                $link = call_user_func_array([new $class, $method], $arguments);

                if ($link === null || ! $link instanceof Link) {
                    return null;
                }

                if ($link->name() !== $link->routeName()) {
                    return $link;
                }

                return $link->as(Str::snake($method));
            })
            ->filter();
    }
}
