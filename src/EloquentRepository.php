<?php namespace Bosnadev\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;

/**
 * Class EloquentRepository
 * @package Bosnadev\Repositories
 */
abstract class EloquentRepository implements RepositoryInterface {

    /**
     * Model instance
     *
     * @var mixed
     */
    protected $model;

    public function __construct() {
        $this->model = $this->getModelClass();
    }

    /**
     * We require implementation of this method because we need to know
     * Eloquent model class associated with this repository.
     * Use full namespace
     *
     * @return mixed
     */
    abstract function getModelClass();
}