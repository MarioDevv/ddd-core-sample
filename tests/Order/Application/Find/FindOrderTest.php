<?php

namespace ddd\core\tests\Order\Application\Find;

use ddd\core\Order\Application\Find\FindOrder;
use ddd\core\Order\Application\Find\FindOrderResponse;
use ddd\core\tests\Order\Domain\OrderMother;
use ddd\core\tests\Order\OrderUnitTestHelper;
use Exception;

class FindOrderTest extends OrderUnitTestHelper
{

    private FindOrder|null $findOrder = null;


    protected function setUp(): void
    {
        parent::setUp();
        $this->findOrder = new FindOrder($this->repository());
    }

    /**
     * @test
     */
    public function it_should_find_an_order(): void
    {
        $request = FindOrderRequestMother::random();
        $order = OrderMother::random(id: $request->id());

        $this->findById($order->id(), $order);

        $expectedResponse = new FindOrderResponse($order);

        $this->assertEquals($expectedResponse, ($this->findOrder)($request));
    }

    /**
     * @test
     */
    public function it_should_throw_an_exception_when_order_not_found()
    {

        $this->expectException(Exception::class);

        $request = FindOrderRequestMother::random();

        $this->findById($request->id(), null);

        ($this->findOrder)($request);

    }


}
