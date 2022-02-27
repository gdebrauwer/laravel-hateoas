<?php

namespace GDebrauwer\Hateoas;

use GDebrauwer\Hateoas\Exceptions\LinkException;
use GDebrauwer\Hateoas\Formatters\CallbackFormatter;
use GDebrauwer\Hateoas\Formatters\Formatter;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Throwable;

class HateoasManager
{
    protected $guessHateoasClassNameUsingCallback = null;

    public function generate(string $class, array $arguments = []) : array
    {
        $hateoasClass = $this->guessHateoasClassName($class);

        if (class_exists($hateoasClass)) {
            $class = $hateoasClass;
        }

        try {
            return $this->getLinksFrom($class, $arguments)->format();
        } catch (Throwable $exception) {
            if ($exception instanceof LinkException) {
                throw $exception;
            }

            return (new LinkCollection())->format();
        }
    }

    protected function getLinksFrom(string $class, array $arguments = []) : LinkCollection
    {
        $links = collect(get_class_methods($class))
            ->filter(function ($method) {
                return ! Str::startsWith($method, '__');
            })
            ->map(function ($method) use ($class, $arguments) {
                $link = call_user_func_array([app($class), $method], $arguments);

                if ($link === null || ! $link instanceof Link) {
                    return;
                }

                if ($link->name() !== $link->routeName()) {
                    return $link;
                }

                return $link->as(Str::snake($method));
            })
            ->filter()
            ->values();

        return LinkCollection::make($links);
    }

    protected function guessHateoasClassName(string $class) : string
    {
        if ($this->guessHateoasClassNameUsingCallback !== null) {
            return call_user_func($this->guessHateoasClassNameUsingCallback, $class);
        }

        $classDirname = str_replace('/', '\\', dirname(str_replace('\\', '/', $class)));

        $classDirnameSegments = explode('\\', $classDirname);

        return Collection::times(count($classDirnameSegments), function ($index) use ($class, $classDirnameSegments) {
            $classDirname = implode('\\', array_slice($classDirnameSegments, 0, $index));

            return $classDirname . '\\Hateoas\\' . class_basename($class) . 'Hateoas';
        })->reverse()->values()->first(function ($class) {
            return class_exists($class);
        }) ?: $classDirname . '\\Hateoas\\' . class_basename($class) . 'Hateoas';
    }

    public function guessHateoasClassNameUsing(callable $callback) : self
    {
        $this->guessHateoasClassNameUsingCallback = $callback;

        return $this;
    }

    public function formatLinksUsing($formatter) : self
    {
        if (is_callable($formatter)) {
            $formatter = new CallbackFormatter($formatter);
        } elseif (is_string($formatter) && class_exists($formatter)) {
            if (! is_subclass_of($formatter, $interface = Formatter::class)) {
                throw new InvalidArgumentException(
                    "`{$formatter}` class does not implement the `{$interface}` interface"
                );
            }

            $formatter = app($formatter);
        } else {
            throw new InvalidArgumentException("`{$formatter}` is neither a valid classname or a function");
        }

        app()->bind(Formatter::class, function () use ($formatter) {
            return $formatter;
        });

        return $this;
    }
}
