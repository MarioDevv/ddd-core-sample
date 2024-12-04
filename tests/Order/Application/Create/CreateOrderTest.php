<?php

namespace ddd\core\tests\Order\Application\Create;

use ddd\core\Order\Application\Create\CreateOrder;
use ddd\core\Order\Application\Create\CreateOrderResponse;
use ddd\core\tests\Order\Domain\OrderMother;
use ddd\core\tests\Order\OrderUnitTestHelper;

class CreateOrderTest extends OrderUnitTestHelper
{

    private CreateOrder|null $createOrder = null;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->createOrder = new CreateOrder($this->repository());
    }
    
    /**
     * @test
     */
    public function it_should_create_an_order()
    {

        $request = CreateOrderRequestMother::random();

        $order = OrderMother::fromCreateRequest($request);

        $this->nextOrderIdentity($order->id());

        $lineIds = array_keys($order->lines());

        foreach ($lineIds as $lineId) {
            $this->nextOrderLineIdentity($lineId);
        }

        $this->persist($order);

        $expectedResponse = new CreateOrderResponse($order);

        $this->assertEquals($expectedResponse, ($this->createOrder)($request));
    }

}
