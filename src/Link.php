<?php

namespace GDebrauwer\Hateoas;

use GDebrauwer\Hateoas\Exceptions\LinkException;
use Illuminate\Routing\Exceptions\UrlGenerationException;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use InvalidArgumentException;
use Throwable;

class Link
{
    protected string $name;

    protected string $routeName;

    protected array $routeParameters;

    public function __construct(string $routeName, array $routeParameters = [])
    {
        $this->name = $routeName;
        $this->routeName = $routeName;
        $this->routeParameters = $routeParameters;
    }

    public static function make(string $routeName, array $routeParameters = [])
    {
        return new self($routeName, $routeParameters);
    }

    public function as(string $name) : self
    {
        $this->name = $name;

        return $this;
    }

    public function name() : string
    {
        return $this->name;
    }

    /**
     * @throws \GDebrauwer\Hateoas\Exceptions\LinkException
     */
    public function method() : string
    {
        return once(function () {
            return collect($this->route()->methods)->first(function ($method) {
                return $method !== 'HEAD';
            });
        });
    }

    /**
     * @throws \GDebrauwer\Hateoas\Exceptions\LinkException
     */
    public function path() : string
    {
        return once(function () {
            try {
                return route($this->routeName, $this->routeParameters, false);
            } catch (Throwable $exception) {
                if ($exception instanceof InvalidArgumentException) {
                    throw LinkException::routeNotFound($this->name, $this->routeName);
                }

                if ($exception instanceof UrlGenerationException) {
                    throw LinkException::routeMissingParameters($this->name, $this->routeName, $exception);
                }

                throw $exception;
            }
        });
    }

    /**
     * @throws \GDebrauwer\Hateoas\Exceptions\LinkException
     */
    public function url() : string
    {
        return once(function () {
            try {
                return route($this->routeName, $this->routeParameters);
            } catch (Throwable $exception) {
                if ($exception instanceof InvalidArgumentException) {
                    throw LinkException::routeNotFound($this->name, $this->routeName);
                }

                if ($exception instanceof UrlGenerationException) {
                    throw LinkException::routeMissingParameters($this->name, $this->routeName, $exception);
                }

                throw $exception;
            }
        });
    }

    public function routeName() : string
    {
        return $this->routeName;
    }

    /**
     * @throws \GDebrauwer\Hateoas\Exceptions\LinkException
     */
    protected function route() : Route
    {
        return once(function () {
            $route = app(Router::class)->getRoutes()->getByName($this->routeName);

            if ($route === null) {
                throw LinkException::routeNotFound($this->name, $this->routeName);
            }

            return $route;
        });
    }
}
