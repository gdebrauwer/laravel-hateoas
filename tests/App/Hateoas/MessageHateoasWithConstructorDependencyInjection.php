<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Tests\App\Models\Message;
use GDebrauwer\Hateoas\Traits\CreatesLinks;
use Illuminate\Cache\CacheManager;

class MessageHateoasWithConstructorDependencyInjection
{
    use CreatesLinks;

    protected CacheManager $cache;

    public function __construct(CacheManager $cache)
    {
        $this->cache = $cache;
    }

    public function self(Message $message) : ?Link
    {
        return $this->link('message.show', ['message' => $message->id]);
    }
}
