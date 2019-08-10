<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Tests\App\Message;

class MessageHateoas
{
    public function self(Message $message)
    {
        return new Link('message.show', ['message' => $message->id]);
    }

    public function reply(Message $message)
    {
        return new Link('message.reply', ['message' => $message->id]);
    }

    public function delete(Message $message)
    {
        return new Link('message.destroy', ['message' => $message->id]);
    }
}
