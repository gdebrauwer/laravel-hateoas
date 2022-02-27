<?php

namespace GDebrauwer\Hateoas\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class HateoasMakeCommand extends GeneratorCommand
{
    protected $name = 'make:hateoas';

    protected $description = 'Create a new HATEOAS class';

    protected $type = 'Hateoas';

    protected function buildClass($name) : string
    {
        $stub = parent::buildClass($name);

        $model = $this->option('model');

        return $model ? $this->replaceModel($stub, $model) : $stub;
    }

    protected function replaceModel($stub, $model) : string
    {
        $model = str_replace('/', '\\', $model);

        $namespacedModel = $this->qualifyModel($model);

        if (Str::startsWith($model, '\\')) {
            $stub = str_replace('NamespacedDummyModel', trim($model, '\\'), $stub);
        } else {
            $stub = str_replace('NamespacedDummyModel', $namespacedModel, $stub);
        }

        $stub = str_replace(
            "use {$namespacedModel};\nuse {$namespacedModel};",
            "use {$namespacedModel};",
            $stub
        );

        $model = class_basename(trim($model, '\\'));

        $stub = str_replace('DocDummyModel', Str::snake($model, ' '), $stub);

        $stub = str_replace('DummyModel', $model, $stub);

        return str_replace('dummyModel', Str::camel($model), $stub);
    }

    protected function getStub() : string
    {
        return $this->option('model') ? __DIR__ . '/stubs/hateoas.stub' : __DIR__ . '/stubs/hateoas.plain.stub';
    }

    protected function getDefaultNamespace($rootNamespace) : string
    {
        return $rootNamespace . '\Hateoas';
    }

    protected function getOptions() : array
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'The model that the HATEOAS class applies to'],
        ];
    }
}
