<?php

namespace JetBox\Repositories\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;

class MakeAbstractRepositoryCommand extends GeneratorCommand
{
    /**
     * @var bool
     */
    protected $hidden = true;

    /**
     * @var string
     */
    protected $name = 'make:abstract-repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model abstract repository class';

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
    protected function getDefaultNamespace($rootNamespace): string
    {
        return config('repository.repository_namespace');
    }

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__ . '/../../../stubs/abstract-repository.stub';
    }

    /**
     * @param string $name
     * @return string
     * @throws FileNotFoundException
     */
    protected function buildClass($name): string
    {
        return parent::buildClass($name);
    }
}
