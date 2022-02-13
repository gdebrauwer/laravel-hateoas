<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Tests\App\Models\Message;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class MessageHateoasThatResultsInALinkException
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
        return $this->link('message.show');
    }
}
