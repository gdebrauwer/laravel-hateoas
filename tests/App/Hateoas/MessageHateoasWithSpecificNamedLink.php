<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Tests\App\Models\Message;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class MessageHateoasWithSpecificNamedLink
{
    use CreatesLinks;

    /**
     * Get the HATEOAS link to view the message.
     *
     * @param \App\Message $message
     *
     * @return \GDebrauwer\Hateoas\Link|null
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
     * @return \GDebrauwer\Hateoas\Link|null
     */
    public function delete(Message $message)
    {
        return $this->link('message.destroy', ['message' => $message->id])->as('removeFromThread');
    }
}
