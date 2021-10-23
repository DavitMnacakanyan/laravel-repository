<?php

namespace JetBox\Repositories\Console\Commands;

use Illuminate\Console\Command;
use JetBox\Repositories\RepositoryServiceProvider;

class RepositoryInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repository:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Repository Install Publish Config Make Abstract Repository Class';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Publishing the Repository config, and make AbstractRepository');

        $this->call('vendor:publish', [
            '--provider' => RepositoryServiceProvider::class
        ]);

        $this->call('make:abstract-repository', [
           'name' => 'AbstractRepository'
        ]);
    }
}
