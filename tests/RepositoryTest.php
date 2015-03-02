<?php namespace Bosnadev\Tests\Repositories;

use Bosnadev\Repositories\Contracts\CriteriaInterface as Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;
use Bosnadev\Repositories\Eloquent\EloquentRepository;
use Illuminate\Database\Eloquent\Model;
use \Mockery as m;
use \PHPUnit_Framework_TestCase as TestCase;

class RepositoryTest extends TestCase {

    protected $mock;

    protected $repository;

    public function setUp() {
        $this->mock = m::mock('Illuminate\Database\Eloquent\Model');
    }
}

