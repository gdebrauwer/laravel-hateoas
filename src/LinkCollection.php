<?php

namespace GDebrauwer\Hateoas;

use GDebrauwer\Hateoas\Formatters\Formatter;
use Illuminate\Support\Collection;

class LinkCollection extends Collection
{
    /**
     * Format the links to JSON format.
     *
     * @return array
     */
    public function format()
    {
        return app(Formatter::class)->format($this);
    }
}
