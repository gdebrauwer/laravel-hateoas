<?php

namespace GDebrauwer\Hateoas\Exceptions;

use Exception;
use Throwable;

class LinkException extends Exception
{
    /**
     * @param string $linkName
     * @param string $routeName
     *
     * @return self
     */
    public static function routeNotFound(string $linkName, string $routeName)
    {
        return new static(
            "Link with name `{$linkName}` could not be created " .
            "because route with name `{$routeName}` could not be found"
        );
    }

    /**
     * @param string $linkName
     * @param string $routeName
     * @param \Throwable $previous
     *
     * @return self
     */
    public static function routeMissingParameters(string $linkName, string $routeName, Throwable $previous)
    {
        return new static(
            "Link with name `{$linkName}` could not be created " .
            "because not all parameters for route with name `{$routeName}` were provided",
            0,
            $previous
        );
    }
}
