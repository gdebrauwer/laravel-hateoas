<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Tests\App\Models\Message;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class MessageHateoasThatResultsInAnNonLinkException
{
    use CreatesLinks;

    public function self(int $number, Message $message) : ?Link
    {
        return $this->link('message.show', ['message' => $message->id]);
    }
}
