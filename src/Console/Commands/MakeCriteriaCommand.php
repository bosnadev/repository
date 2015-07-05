<?php

namespace Bosnadev\Repositories\Console\Commands;

use Bosnadev\Repositories\Console\Commands\Creators\CriteriaCreator;
use Illuminate\Console\Command;
use Illuminate\Foundation\Composer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class MakeCriteriaCommand
 *
 * @package Bosnadev\Repositories\Console\Commands
 */
class MakeCriteriaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:criteria';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new criteria class';

    /**
     * @var
     */
    protected $creator;

    /**
     * @var
     */
    protected $composer;

    /**
     * @param CriteriaCreator $creator
     * @param Composer        $composer
     */
    public function __construct(CriteriaCreator $creator, Composer $composer)
    {
        parent::__construct();

        // Set the creator.
        $this->creator  = $creator;

        // Set the composer.
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

        // Write criteria.
        $this->writeCriteria($arguments, $options);

        // Dump autoload.
        $this->composer->dumpAutoloads();
    }

    /**
     * Write the criteria.
     *
     * @param $arguments
     * @param $options
     */
    public function writeCriteria($arguments, $options)
    {
        // Set criteria.
        $criteria = $arguments['criteria'];

        // Set model.
        $model    = $options['model'];

        // Create the criteria.
        if($this->creator->create($criteria, $model))
        {
            // Information message.
            $this->info("Succesfully created the criteria class.");
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
            ['criteria', InputArgument::REQUIRED, 'The criteria name.']
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
