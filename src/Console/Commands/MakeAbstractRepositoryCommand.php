<?php

namespace JetBox\Repositories\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;

class MakeAbstractRepositoryCommand extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:abstract-repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model repository class';

    /**
     * @var string
     */
    protected $namespace = 'App\\Repositories';

    /**
     * @var string
     */
    protected $type = 'AbstractRepository';

    /**
     * Create a new command instance.
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct($filesystem);
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $this->namespace;
    }

    /**
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../../../stubs/abstract-repository.stub';
    }

    /**
     * @param string $name
     * @return mixed|string|string[]
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        return parent::buildClass($name);
    }
}