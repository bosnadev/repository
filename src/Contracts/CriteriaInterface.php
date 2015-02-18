<?php namespace Bosnadev\Repositories\Contracts;

/**
 * Interface CriteriaInterface
 * @package Bosnadev\Repositories\Contracts
 */
interface CriteriaInterface {

    /**
     * @param $query
     * @return mixed
     */
    public function apply($query);
}