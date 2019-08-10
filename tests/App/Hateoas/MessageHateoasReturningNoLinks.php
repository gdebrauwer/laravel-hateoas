<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Tests\App\Message;

class MessageHateoasReturningNoLinks
{
    public function self(Message $message)
    {
        return null;
    }

    public function reply(Message $message)
    {
        return null;
    }

    public function delete(Message $message)
    {
        return null;
    }
}
