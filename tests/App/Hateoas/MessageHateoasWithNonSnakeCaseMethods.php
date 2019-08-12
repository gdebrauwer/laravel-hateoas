<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Tests\App\Message;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class MessageHateoasWithNonSnakeCaseMethods
{
    use CreatesLinks;

    /**
     * Get the HATEOAS link to view the message.
     *
     * @param \App\Message $message
     *
     * @return mixed
     */
    public function self(Message $message)
    {
        return $this->link('message.show', ['message' => $message->id]);
    }

    /**
     * Get the HATEOAS link to delete the message.
     *
     * @param \App\Message $message
     *
     * @return mixed
     */
    public function removeFromThread(Message $message)
    {
        return $this->link('message.destroy', ['message' => $message->id]);
    }
}
