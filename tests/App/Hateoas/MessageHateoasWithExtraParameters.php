<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Tests\App\Models\Message;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class MessageHateoasWithExtraParameters
{
    use CreatesLinks;

    public function self(Message $message, int $number, string $text) : ?Link
    {
        return $this->link('message.show', ['message' => $text]);
    }

    public function delete(Message $message, int $number) : ?Link
    {
        return $this->link('message.destroy', ['message' => $number]);
    }
}
