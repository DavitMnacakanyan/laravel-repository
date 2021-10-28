<?php

namespace JetBox\Repositories;

use JetBox\Repositories\Console\Commands\MakeAbstractRepositoryCommand;
use JetBox\Repositories\Console\Commands\MakeRepositoryCommand;
use Illuminate\Support\ServiceProvider;
use JetBox\Repositories\Console\Commands\RepositoryInstallCommand;
use JetBox\Repositories\Contracts\FileContract;
use JetBox\Repositories\Services\FileService;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->makeFileService();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/repository.php' => config_path('repository.php')
        ], 'repository-config');

        $this->mergeConfigFrom(__DIR__ . '/../config/repository.php', 'repository');

        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeAbstractRepositoryCommand::class,
                MakeRepositoryCommand::class,
                RepositoryInstallCommand::class
            ]);
        }
    }

    /**
     * File Contract
     */
    private function makeFileService()
    {
        $this->app->singleton(FileContract::class, function ($app) {
            return new FileService();
        });
    }
}
