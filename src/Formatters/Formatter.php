<?php

namespace GDebrauwer\Hateoas\Formatters;

use GDebrauwer\Hateoas\LinkCollection;

interface Formatter
{
    public function format(LinkCollection $links) : array;
}
