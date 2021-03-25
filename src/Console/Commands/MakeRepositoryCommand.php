<?php

namespace JetBox\Repositories\Console\Commands;

use JetBox\Repositories\Eloquent\AbstractRepository;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;


class MakeRepositoryCommand extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:repository';

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
    protected $type = 'Repository';

    /**
     * @var string
     */
    protected $abstractNamespace = AbstractRepository::class;

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
        return __DIR__ . '/../../../stubs/repository.stub';
    }

    /**
     * @param string $name
     * @return mixed|string|string[]
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        if (!file_exists(app_path('Repositories/AbstractRepository.php'))) {
            $this->call('make:abstract-repository', [
                'name' => 'AbstractRepository'
            ]);
        }

//        $stub = str_replace('AbstractRepositoryNamespace', $this->abstractNamespace, $stub);

        return $this->checkCommand($stub);
    }

    /**
     * @param $stub
     * @return mixed|string|string[]
     */
    protected function checkCommand($stub)
    {
        // Command Line make:repository UserRepository
        $nameInput = $this->getNameInput();
        $checkCommandRepository = substr($nameInput, strpos($nameInput, 'Repository'));

        if ($checkCommandRepository === 'Repository') {
//            $modelNamespace = $this->qualifyModel($nameInput);
            $modelNamespace = config('repository.app_model') . '\\' . $nameInput;
            $modelNamespace = substr($modelNamespace, 0, strpos($modelNamespace, 'Repository'));
            $nameInput = substr($nameInput, 0, strpos($nameInput, 'Repository'));
            $nameInput = Str::singular($nameInput);
            $modelNamespace = Str::singular($modelNamespace);

            $stub = str_replace('DummyModelNamespace', $modelNamespace, $stub);
            $stub = str_replace('DummyModelClass', $nameInput, $stub);

            return $stub;
        }

        $this->error('Error');

        return false;
    }

    /**
     * @return array[]
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the repository class'],
        ];
    }
}
