<?php

namespace ddd\core\tests\Order;

use ddd\core\Order\Domain\Contracts\OrderRepository;
use ddd\core\Order\Domain\Order;
use ddd\core\tests\Common\Domain\Number;
use ddd\core\tests\Common\Infrastructure\PhpUnitTestCase;
use ddd\core\tests\Order\Domain\OrderMother;
use Mockery;
use Mockery\MockInterface;

class OrderUnitTestHelper extends PhpUnitTestCase
{

    private OrderRepository|MockInterface|null $repository = null;


    protected function nextOrderIdentity(?int $id = null): void
    {
        $this->repository()
            ->shouldReceive('nextOrderIdentity')
            ->once()
            ->andReturn($id ?? Number::random());
    }

    protected function nextOrderLineIdentity(?int $id = null): void
    {
        $this->repository()
            ->shouldReceive('nextOrderLineIdentity')
            ->once()
            ->andReturn($id ?? Number::random());
    }

    protected function persist(Order $order): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with($this->equalTo($order))
            ->andReturn();
    }

    protected function findById(int $id, ?Order $order): void
    {
        $this->repository()
            ->shouldReceive('findById')
            ->with($this->equalTo($id))
            ->andReturn($order);
    }


    protected function repository(): MockInterface|OrderRepository
    {
        return $this->repository ??= $this->mock(OrderRepository::class);
    }
}
