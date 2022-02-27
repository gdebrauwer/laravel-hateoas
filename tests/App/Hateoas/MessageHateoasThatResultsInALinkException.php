<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Tests\App\Models\Message;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class MessageHateoasThatResultsInALinkException
{
    use CreatesLinks;

    public function self(Message $message) : ?Link
    {
        return $this->link('message.show');
    }
}
