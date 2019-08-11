<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Tests\App\Message;

class MessageHateoasReturningNotAllLinks
{
    /**
     * Get the HATEOAS link to view the message.
     *
     * @param \App\Message $message
     *
     * @return mixed
     */
    public function self(Message $message)
    {
        return Link::make('message.show', ['message' => $message->id]);
    }

    /**
     * Get the HATEOAS link to reply to the message.
     *
     * @param \App\Message $message
     *
     * @return mixed
     */
    public function reply(Message $message)
    {
        return Link::make('message.reply', ['message' => $message->id]);
    }

    /**
     * Get the HATEOAS link to delete the message.
     *
     * @param \App\Message $message
     *
     * @return mixed
     */
    public function delete(Message $message)
    {
        return null;
    }
}
