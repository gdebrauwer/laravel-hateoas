<?php

namespace GDebrauwer\Hateoas\Formatters;

use GDebrauwer\Hateoas\LinkCollection;

class CallbackFormatter implements Formatter
{
    /**
     * The callback that will be used to format the link collection.
     *
     * @var callable
     */
    protected $callback;

    /**
     * Create a new formatter instance.
     *
     * @param callable $callback
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * Format the links to the desired JSON format.
     *
     * @param \GDebrauwer\Hateoas\LinkCollection $links
     *
     * @return array
     */
    public function format(LinkCollection $links)
    {
        return call_user_func($this->callback, $links);
    }
}
