<?php namespace Bosnadev\Repositories\Contracts;

use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

/**
 * Interface CriteriaInterface
 * @package Bosnadev\Repositories\Contracts
 */
interface CriteriaInterface {

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, Repository $repository);
}