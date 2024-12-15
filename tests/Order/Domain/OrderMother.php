<?php

namespace ddd\core\tests\Order\Domain;

use ddd\core\Order\Application\Create\CreateOrderRequest;
use ddd\core\Order\Domain\Order;
use ddd\core\Order\Domain\OrderStatus;
use ddd\core\tests\Common\Domain\Number;

class OrderMother
{

    public static function random(
        ?int $id = null,
        ?int $customerId = null,
        ?int $status = null,
        ?array $lines = null
    ): Order
    {
        $orderId = $id ?? Number::random();

        return new Order(
            $orderId,
            Number::random($customerId),
            OrderStatusMother::random($status),
            $lines ?? self::randomLines($orderId)
        );
    }

    public static function fromCreateRequest(CreateOrderRequest $request): Order
    {

        $order = new Order(
            Number::random(),
            $request->clientId(),
            new OrderStatus(OrderStatus::PENDING),
        );

        foreach ($request->orderLines() as $line) {
            $order->addLine(
                Number::random(),
                $order->id(),
                $line['name'],
                $line['quantity'],
                $line['price'],
            );
        }

        return $order;

    }

    private static function randomLines(int $orderId): array
    {
        $lines = [];

        for ($i = 0; $i < 3; $i++) {
            $line = OrderLineMother::random($orderId);
            $lines[$line->id()] = $line;
        }

        return $lines;
    }

}
