<?php namespace Bosnadev\Tests\Repositories;

use Bosnadev\Repositories\Contracts\CriteriaInterface as Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;
use Bosnadev\Repositories\Eloquent\Repository;
use Illuminate\Database\Eloquent\Model;
use \Mockery as m;
use \PHPUnit_Framework_TestCase as TestCase;

class RepositoryTest extends TestCase {

    protected $mock;

    protected $repository;

    protected $app;

    protected $col;

    public function setUp()
    {
        $this->mock = m::mock('Illuminate\Database\Eloquent\Model');
        $this->app = m::mock('Illuminate\Container\Container');
        $this->col = m::mock('Illuminate\Support\Collection');

        $this->repository = new Repository($this->app, $this->col);
        $this->repository->setModel('TestModel');
    }

    /** @test */
    public function test_paginate()
    {
        $this->assertInstanceOf($this->mock, TestModel::class);
    }

}

class TestModel extends \Illuminate\Database\Eloquent\Model {}
