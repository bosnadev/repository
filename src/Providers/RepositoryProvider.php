<?php

namespace Bosnadev\Repositories\Providers;

use Bosnadev\Repositories\Console\Commands\Creators\RepositoryCreator;
use Bosnadev\Repositories\Console\Commands\MakeCriteriaCommand;
use Bosnadev\Repositories\Console\Commands\MakeRepositoryCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemServiceProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryProvider
 *
 * @package Bosnadev\Repositories\Providers
 */
class RepositoryProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Config path.
        $config_path = __DIR__ . '/../config/repositories.php';

        // Publish config.
        $this->publishes(
            [$config_path => config_path('repositories.php')],
            'repositories'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Register make repository command.
        $this->registerMakeRepositoryCommand();

        // Register make criteria command.
        $this->registerMakeCriteriaCommand();

        // Config path.
        $config_path = __DIR__ . '/../config/repositories.php';

        // Merge config.
        $this->mergeConfigFrom(
            $config_path,
            'repositories'
        );
    }

    /**
     * Register the make:repository command.
     */
    protected function registerMakeRepositoryCommand()
    {
        // Make repository command.
        $this->commands('Bosnadev\Repositories\Console\Commands\MakeRepositoryCommand');
    }

    /**
     * Register the make:criteria command.
     */
    protected function registerMakeCriteriaCommand()
    {
        // Make criteria command.
        $this->commands('Bosnadev\Repositories\Console\Commands\MakeCriteriaCommand');
    }
}
