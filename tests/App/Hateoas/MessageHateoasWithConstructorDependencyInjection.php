<?php

namespace GDebrauwer\Hateoas\Tests\App\Hateoas;

use Illuminate\Cache\CacheManager;
use GDebrauwer\Hateoas\Tests\App\Message;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class MessageHateoasWithConstructorDependencyInjection
{
    use CreatesLinks;

    /**
     * @var \Illuminate\Cache\CacheManager
     */
    protected $cache;

    /**
     * Create a new HATEOAS instance.
     *
     * @param \Illuminate\Cache\CacheManager  $cache
     */
    public function __construct(CacheManager $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Get the HATEOAS link to view the message.
     *
     * @param \App\Message $message
     *
     * @return null|\GDebrauwer\Hateoas\Link
     */
    public function self(Message $message)
    {
        return $this->link('message.show', ['message' => $message->id]);
    }
}
