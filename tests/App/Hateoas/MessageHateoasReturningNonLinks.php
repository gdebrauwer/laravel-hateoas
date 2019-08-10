<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Tests\App\Message;

class MessageHateoasReturningNonLinks
{
    public function self(Message $message)
    {
        return new Link('message.show', ['message' => $message->id]);
    }

    public function reply(Message $message)
    {
        return [
            'random key' => 'random value',
        ];
    }

    public function delete(Message $message)
    {
        return $message;
    }
}
