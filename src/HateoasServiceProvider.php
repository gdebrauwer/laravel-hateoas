<?php

namespace GDebrauwer\Hateoas;

use GDebrauwer\Hateoas\HateoasManager;
use Illuminate\Support\ServiceProvider;

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
    }
}
