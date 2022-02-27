<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Tests\App\Models\Message;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class MessageHateoasReturningNotAllLinks
{
    use CreatesLinks;

    public function self(Message $message) : ?Link
    {
        return $this->link('message.show', ['message' => $message->id]);
    }

    public function reply(Message $message) : ?Link
    {
        return $this->link('message.reply', ['message' => $message->id]);
    }

    public function delete(Message $message) : ?Link
    {
        return null;
    }
}
