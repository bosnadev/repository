<?php

namespace Bosnadev\Tests\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use Illuminate\Container\Container;
use Mockery as m;

/**
 * Class FindOrFailTest
 * @todo test columns
 * @package Bosnadev\Tests\Repositories
 */
class FindOrFailTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Mockery
     */
    protected $modelMock;

    /**
     * @var Container
     */
    protected $containerMock;

    public function setUp()
    {
    }

    public function tearDown()
    {
        m::close();
    }

    public function testFindOrFail()
    {
        $items = [['id' => 10, 'data' => 'abc']];
        $this->reinitMocks(collect($items));

        /** @var RepositoryInterface $sut */
        $sut = $this->getMockForAbstractClass(
            Repository::class,
            [$this->containerMock, collect($items)]
        );

        $result = $sut->findOrFail(10);

        $this->assertEquals($result->count(), count($items));
        $this->assertEquals($result->all(), $items);
    }

    protected function reinitMocks($collection = null)
    {
        $this->modelMock = m::mock('Illuminate\Database\Eloquent\Model')
            ->shouldReceive([
                'find' => $collection,
                'first' => $collection,
            ])
            ->getMock();

        $this->modelMock = $this->modelMock
            ->shouldReceive('where')
            ->andReturn($this->modelMock)
            ->getMock();

        $this->containerMock = m::mock(Container::class)
            ->expects('make')
            ->andReturn($this->modelMock)
            ->getMock();
    }

    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testFindOrFailNothingFound()
    {
        $this->reinitMocks();

        /** @var RepositoryInterface $sut */
        $sut = $this->getMockForAbstractClass(
            Repository::class,
            [$this->containerMock, collect([])]
        );

        $sut->findOrFail(10);
    }

    public function testFindByOrFail()
    {
        $items = [['id' => 10, 'hash' => 'abc']];
        $this->reinitMocks(collect($items));

        /** @var RepositoryInterface $sut */
        $sut = $this->getMockForAbstractClass(
            Repository::class,
            [$this->containerMock, collect($items)]
        );

        $result = $sut->findByOrFail('id', 10);
        $this->assertEquals($result->count(), count($items));
        $this->assertEquals($result->all(), $items);

        $result = $sut->findByOrFail('hash', 'abc');
        $this->assertEquals($result->count(), count($items));
        $this->assertEquals($result->all(), $items);
    }

    /**
     * @expectedException \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function testFindByOrFailNothingFound()
    {
        $this->reinitMocks();

        /** @var RepositoryInterface $sut */
        $sut = $this->getMockForAbstractClass(
            Repository::class,
            [$this->containerMock, collect([])]
        );

        $sut->findByOrFail('id', 10);
    }
}
