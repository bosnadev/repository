<?php namespace Bosnadev\Repositories\Eloquent;

use Bosnadev\Repositories\Contracts\CriteriaInterface as Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Traits\ModelTrait;

use Illuminate\Support\Collection;
use Illuminate\Container\Container as App;

/**
 * Class Repository
 * @package Bosnadev\Repositories\Eloquent
 */
abstract class Repository implements RepositoryInterface {

    use ModelTrait {
        ModelTrait::__construct as private __mtConstruct;
    }

    /**
     * @var Collection
     */
    protected $criteria;

    /**
     * @var
     */
    protected $query;

    /**
     * @var bool
     */
    protected $skipCriteria = false;

    /**
     * @param App $app
     * @throws \Bosnadev\Repositories\Exceptions\RepositoryException
     */
    public function __construct(App $app) {
        $this->__mtConstruct($app);

        $this->model = $this->newModelInstance();
        $this->criteria = new Collection();
        $this->resetScope();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function update(array $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        // TODO: Implement find() method.
    }

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($field, $value, $columns = array('*'))
    {
        // TODO: Implement findBy() method.
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        $this->applyCriteria();

        return $this->query->get($columns);
    }


    /**
     * @return $this
     */
    public function resetScope() {
        $this->query = $this->model;
        $this->skipCriteria(false);
        return $this;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function skipCriteria($status = true){
        $this->skipCriteria = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCriteria() {
        return $this->criteria;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function getByCriteria(Criteria $criteria) {
        $this->query = $criteria->apply($this->query, $this);

        return $this;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function pushCriteria(Criteria $criteria) {
        $this->criteria->push($criteria);

        return $this;
    }

    /**
     * @return $this
     */
    public function  applyCriteria() {

        if($this->skipCriteria === true)
            return $this;

        foreach($this->getCriteria() as $criteria) {
            if($criteria instanceof Criteria)
                $this->query = $criteria->apply($this->query, $this);
        }

        return $this;
    }
}