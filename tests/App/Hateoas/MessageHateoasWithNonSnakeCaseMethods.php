<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Tests\App\Message;

class MessageHateoasWithNonSnakeCaseMethods
{
    public function self(Message $message)
    {
        return new Link('message.show', ['message' => $message->id]);
    }

    public function removeFromThread(Message $message)
    {
        return new Link('message.destroy', ['message' => $message->id]);
    }
}
