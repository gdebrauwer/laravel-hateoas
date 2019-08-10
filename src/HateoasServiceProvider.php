<?php

namespace GDebrauwer\Hateoas;

use GDebrauwer\Hateoas\HateoasManager;
use Illuminate\Support\ServiceProvider;
use GDebrauwer\Hateoas\Formatters\Formatter;
use GDebrauwer\Hateoas\Formatters\DefaultFormatter;

class HateoasServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton('hateoas', function () {
            return $this->app->make(HateoasManager::class);
        });

        $this->app->bind(Formatter::class, DefaultFormatter::class);
    }
}
