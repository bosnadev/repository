<?php

namespace Bosnadev\Tests\Repositories;

use \Mockery as m;
use \PHPUnit_Framework_TestCase as TestCase;

class RepositoryTest extends TestCase {

    protected $mock;

    protected $repository;

    public function setUp() {
        $this->mock = m::mock('Illuminate\Database\Eloquent\Model');
    }

    public function testRepository()
    {
        $this->assertTrue(true);
    }
}
