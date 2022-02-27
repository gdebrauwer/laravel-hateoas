<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Tests\App\Models\Message;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class MessageHateoasWithNonSnakeCaseMethods
{
    use CreatesLinks;

    public function self(Message $message) : ?Link
    {
        return $this->link('message.show', ['message' => $message->id]);
    }

    public function removeFromThread(Message $message) : ?Link
    {
        return $this->link('message.destroy', ['message' => $message->id]);
    }
}
