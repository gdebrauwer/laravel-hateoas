<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Tests\App\Message;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class MessageHateoasWithExtraParameters
{
    use CreatesLinks;

    /**
     * Get the HATEOAS link to view the message.
     *
     * @param \App\Message $message
     * @param int $number
     * @param string $text
     *
     * @return null|\GDebrauwer\Hateoas\Link
     */
    public function self(Message $message, int $number, string $text)
    {
        return $this->link('message.show', ['message' => $text]);
    }

    /**
     * Get the HATEOAS link to delete the message.
     *
     * @param \App\Message $message
     * @param int $number
     *
     * @return null|\GDebrauwer\Hateoas\Link
     */
    public function delete(Message $message, int $number)
    {
        return $this->link('message.destroy', ['message' => $number]);
    }
}
