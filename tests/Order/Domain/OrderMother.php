<?php

namespace ddd\core\tests\Order\Domain;

use ddd\core\Order\Application\Create\CreateOrderRequest;
use ddd\core\Order\Domain\Order;
use ddd\core\Order\Domain\OrderStatus;
use ddd\core\tests\Common\Domain\Number;

class OrderMother
{

    public static function random(
        ?int   $id = null,
        ?int   $customerId = null,
        ?int   $status = null,
        ?array $lines = null
    ): Order
    {

        $order = new Order(
            Number::random($id),
            Number::random($customerId),
            OrderStatusMother::random($status),
        );

        $lines = $lines ?? self::randomLines();

        foreach ($lines as $line) {
            $order->addLine(
                $line->name()->value(),
                $line->quantity()->value(),
                $line->price()->value(),
            );
        }

        return $order;
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
                $line['name'],
                $line['quantity'],
                $line['price'],
            );
        }

        return $order;

    }

    private static function randomLines(): array
    {
        $lines = [];

        for ($i = 0; $i < 3; $i++) {
            $line    = OrderLineMother::random(position: $i + 1);
            $lines[] = $line;
        }

        return $lines;
    }

}
