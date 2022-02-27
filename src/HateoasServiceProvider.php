<?php

namespace GDebrauwer\Hateoas;

use GDebrauwer\Hateoas\Commands\HateoasMakeCommand;
use GDebrauwer\Hateoas\Formatters\DefaultFormatter;
use GDebrauwer\Hateoas\Formatters\Formatter;
use Illuminate\Support\ServiceProvider;

class HateoasServiceProvider extends ServiceProvider
{
    public function boot() : void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                HateoasMakeCommand::class,
            ]);
        }
    }

    public function register() : void
    {
        $this->app->singleton('hateoas', function () {
            return $this->app->make(HateoasManager::class);
        });

        $this->app->bind(Formatter::class, DefaultFormatter::class);
    }
}
