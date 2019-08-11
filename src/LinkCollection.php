<?php

namespace GDebrauwer\Hateoas;

use Illuminate\Support\Collection;
use GDebrauwer\Hateoas\Formatters\Formatter;

class LinkCollection extends Collection
{
    /**
     * Format the links to JSON format
     *
     * @return array
     */
    public function format()
    {
        return app(Formatter::class)->format($this);
    }
}
