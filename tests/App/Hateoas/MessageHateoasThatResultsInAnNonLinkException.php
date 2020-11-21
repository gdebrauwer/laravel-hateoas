<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Tests\App\Message;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class MessageHateoasThatResultsInAnNonLinkException
{
    use CreatesLinks;

    /**
     * Get the HATEOAS link to view the message.
     *
     * @param int          $number
     * @param \App\Message $message
     *
     * @return null|\GDebrauwer\Hateoas\Link
     */
    public function self(int $number, Message $message)
    {
        return $this->link('message.show', ['message' => $message->id]);
    }
}
