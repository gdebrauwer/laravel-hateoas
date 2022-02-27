<?php

namespace GDebrauwer\Hateoas\Exceptions;

use Exception;
use Throwable;

class LinkException extends Exception
{
    public static function routeNotFound(string $linkName, string $routeName) : self
    {
        return new static(
            "Link with name `{$linkName}` could not be created " .
            "because route with name `{$routeName}` could not be found"
        );
    }

    public static function routeMissingParameters(string $linkName, string $routeName, Throwable $previous) : self
    {
        return new static(
            "Link with name `{$linkName}` could not be created " .
            "because not all parameters for route with name `{$routeName}` were provided",
            0,
            $previous
        );
    }
}
