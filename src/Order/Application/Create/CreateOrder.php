<?php

namespace ddd\core\Order\Application\Create;

use ddd\core\Order\Domain\Contracts\OrderRepository;
use ddd\core\Order\Domain\Order;
use ddd\core\Order\Domain\OrderStatus;

class CreateOrder
{

    public function __construct(
        private readonly OrderRepository $repository
    )
    {
    }

    public function __invoke(CreateOrderRequest $request): CreateOrderResponse
    {

        $order = new Order(
            $this->repository->nextOrderIdentity(),
            $request->clientId(),
            new OrderStatus(OrderStatus::PENDING),
        );

        foreach ($request->orderLines() as $line) {
            $order->addLine(
                $this->repository->nextOrderLineIdentity(),
                $line['name'],
                $line['quantity'],
                $line['price'],
            );
        }

        $this->repository->persist($order);

        return new CreateOrderResponse($order);
    }

}
