<?php

namespace GDebrauwer\Hateoas\Formatters;

use GDebrauwer\Hateoas\LinkCollection;

class CallbackFormatter implements Formatter
{
    protected $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function format(LinkCollection $links) : array
    {
        return call_user_func($this->callback, $links);
    }
}
