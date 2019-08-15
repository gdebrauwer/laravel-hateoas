<?php

namespace GDebrauwer\Hateoas;

use Illuminate\Support\Str;

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
        $hateoasClass = $this->guessHateoasClassName($class);

        if (class_exists($hateoasClass)) {
            $class = $hateoasClass;
        }

        return $this->getLinksFrom($class, $arguments)->format();
    }

    /**
     * Get links from a HATEOAS class.
     *
     * @param string $class
     * @param array $arguments
     *
     * @return \GDebrauwer\Hateoas\LinkCollection
     */
    protected function getLinksFrom(string $class, $arguments = [])
    {
        $links = collect(get_class_methods($class))
            ->map(function ($method) use ($class, $arguments) {
                $link = call_user_func_array([new $class, $method], $arguments);

                if ($link === null || ! $link instanceof Link) {
                    return;
                }

                if ($link->name() !== $link->routeName()) {
                    return $link;
                }

                return $link->as(Str::snake($method));
            })
            ->filter();

        return LinkCollection::make($links);
    }

    /**
     * Guess the HATEOAS class name for the given class.
     *
     * @param string $class
     *
     * @return string
     */
    protected function guessHateoasClassName(string $class)
    {
        $classDirname = str_replace('/', '\\', dirname(str_replace('\\', '/', $class)));

        return $classDirname.'\\Hateoas\\'.class_basename($class).'Hateoas';
    }
}
