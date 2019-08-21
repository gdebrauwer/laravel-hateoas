<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas\CustomGuess;

use GDebrauwer\Hateoas\Tests\App\Message;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class CustomGuessMessageHateoas
{
    use CreatesLinks;

    /**
     * Get the HATEOAS link to view the message.
     *
     * @param \App\Message $message
     *
     * @return null|\GDebrauwer\Hateoas\Link
     */
    public function self(Message $message)
    {
        return $this->link('message.show', ['message' => $message->id])->as('customGuessSelf');
    }
}
