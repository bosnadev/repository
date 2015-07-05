<?php

namespace Bosnadev\Repositories\Console\Commands;

use Bosnadev\Repositories\Console\Commands\Creators\RepositoryCreator;
use Illuminate\Console\Command;
use Illuminate\Foundation\Composer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class MakeRepositoryCommand
 *
 * @package Bosnadev\Repositories\Console\Commands
 */
class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * @var RepositoryCreator
     */
    protected $creator;

    /**
     * @var
     */
    protected $composer;

    /**
     * @param RepositoryCreator $creator
     * @param Composer          $composer
     */
    public function __construct(RepositoryCreator $creator, Composer $composer)
    {
        parent::__construct();

        // Set the creator.
        $this->creator  = $creator;

        // Set composer.
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Get the arguments.
        $arguments = $this->argument();

        // Get the options.
        $options   = $this->option();

        // Write repository.
        $this->writeRepository($arguments, $options);

        // Dump autoload.
        $this->composer->dumpAutoloads();
    }

    /**
     * @param $arguments
     * @param $options
     */
    protected function writeRepository($arguments, $options)
    {
        // Set repository.
        $repository = $arguments['repository'];

        // Set model.
        $model      = $options['model'];

        // Create the repository.
        if($this->creator->create($repository, $model))
        {
            // Information message.
            $this->info("Successfully created the repository class");
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['repository', InputArgument::REQUIRED, 'The repository name.']
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', null, InputOption::VALUE_OPTIONAL, 'The model name.', null],
        ];
    }
}
