<?php

namespace Bosnadev\Repositories\Providers;

use Bosnadev\Repositories\Console\Commands\MakeCriteriaCommand;
use Bosnadev\Repositories\Console\Commands\MakeRepositoryCommand;
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
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMakeRepositoryCommand();
        $this->registerMakeCriteriaCommand();

        $this->commands(['command.repository.make', 'command.criteria.make']);
    }

    /**
     * Register the make:repository command.
     */
    protected function registerMakeRepositoryCommand()
    {
        $this->app->singleton('command.repository.make', function()
        {
            return new MakeRepositoryCommand();
        });
    }

    /**
     * Register the make:criteria command.
     */
    protected function registerMakeCriteriaCommand()
    {
        $this->app->singleton('command.criteria.make', function()
        {
            return new MakeCriteriaCommand();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['command.repository.make', 'command.criteria.make'];
    }
}
