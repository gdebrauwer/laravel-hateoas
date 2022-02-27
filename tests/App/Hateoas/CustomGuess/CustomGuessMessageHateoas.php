<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas\CustomGuess;

use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Tests\App\Models\Message;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class CustomGuessMessageHateoas
{
    use CreatesLinks;

    public function self(Message $message) : ?Link
    {
        return $this->link('message.show', ['message' => $message->id])->as('customGuessSelf');
    }
}
