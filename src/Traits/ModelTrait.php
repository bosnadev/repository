<?php namespace Bosnadev\Repositories\Traits;

use Bosnadev\Repositories\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ModelTrait
 * @package Bosnadev\Repositories\Traits
 */
trait ModelTrait {

    /**
     * Full class name of the Eloquent Model
     *
     * @var null
     */
    protected $modelClassName = null;

    /**
     * Application Container
     *
     * @var
     */
    protected $app;

    /**
     * @param App $app
     */
    public function __construct(App $app) {
        $this->app = $app;

    }

    /**
     * Create new Eloquent Model instance
     *
     * @return mixed
     * @throws RepositoryException
     */
    public function newModelInstance() {

        if($this->modelClassName === null)
            throw new RepositoryException('Please set $modelClassName property to match your model class.');

        if( !class_exists($this->modelClassName))
            throw new RepositoryException("Class {$this->modelClassName} does not exists!");

        return $this->makeModel();
    }

    /**
     * @return mixed
     * @throws RepositoryException
     */
    private function makeModel()
    {
        $model = $this->app->make(($this->modelClassName));

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->modelClassName} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $model;
    }
}