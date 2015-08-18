<?php namespace Bosnadev\Repositories\Contracts;

/**
 * Interface RepositoryInterface
 * @package Bosnadev\Repositories\Contracts
 */
interface RepositoryInterface {

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'));

    /**
     * @param $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 1, $columns = array('*'));

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @return bool
     */
    public function saveModel(array $data);

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'));

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($field, $value, $columns = array('*'));

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findAllBy($field, $value, $columns = array('*'));

    /**
     * @param $where
     * @param array $columns
     * @return mixed
     */
    public function findWhere($where, $columns = array('*'));

}
