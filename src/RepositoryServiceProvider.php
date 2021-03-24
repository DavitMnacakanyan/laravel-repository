<?php

namespace JetBox\Repositories;

use JetBox\Repositories\Console\Commands\MakeAbstractRepositoryCommand;
use JetBox\Repositories\Console\Commands\MakeRepositoryCommand;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeAbstractRepositoryCommand::class,
                MakeRepositoryCommand::class,
            ]);
        }
    }
}
