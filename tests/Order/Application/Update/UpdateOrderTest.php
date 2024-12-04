<?php

namespace ddd\core\tests\Order\Application\Update;

use ddd\core\Order\Application\Update\UpdateOrder;
use ddd\core\tests\Order\Domain\OrderMother;
use ddd\core\tests\Order\OrderUnitTestHelper;
use Exception;

class UpdateOrderTest extends OrderUnitTestHelper
{
    private UpdateOrder|null $updateOrder = null;


    protected function setUp(): void
    {
        parent::setUp();
        $this->updateOrder = new UpdateOrder($this->repository());
    }

    /**
     * @test
     */
    public function it_should_update_an_order()
    {
        $request = UpdateOrderRequestMother::random();
        $order = OrderMother::random(id: $request->orderId());

        $this->findById($order->id(), $order);

        $this->persist($order);

        $this->assertEquals(null, ($this->updateOrder)($request));

    }

    /**
     * @test
     */
    public function it_should_throw_an_error_when_order_not_found()
    {
        $this->expectException(Exception::class);

        $request = UpdateOrderRequestMother::random();

        $this->findById($request->orderId(), null);

        ($this->updateOrder)($request);
    }




}
