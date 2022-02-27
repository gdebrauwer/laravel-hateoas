<?php

namespace GDebrauwer\Hateoas;

use GDebrauwer\Hateoas\Formatters\Formatter;
use Illuminate\Support\Collection;

class LinkCollection extends Collection
{
    public function format() : array
    {
        return app(Formatter::class)->format($this);
    }
}
