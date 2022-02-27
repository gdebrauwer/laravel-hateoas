<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Tests\App\Models\Message;

class MessageHateoasReturningNoLinks
{
    public function self(Message $message) : ?Link
    {
        return null;
    }

    public function reply(Message $message) : ?Link
    {
        return null;
    }

    public function delete(Message $message) : ?Link
    {
        return null;
    }
}
