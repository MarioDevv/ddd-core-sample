<?php

namespace ddd\core\Order\Application\Find;

use ddd\core\Order\Domain\Order;
use ddd\core\Order\Domain\OrderLine;

class FindOrderResponse
{

    public function __construct(
        private readonly Order $order
    )
    {
    }

    public function json(): array
    {
        return [
            'id'       => $this->order->id(),
            'clientId' => $this->order->clientId(),
            'total'    => $this->order->total(),
            'lines'    => array_map(fn(OrderLine $line) => $this->lineToJson($line), $this->order->lines()->toArray())
        ];
    }

    private function lineToJson(OrderLine $line): array
    {
        return [
            'name'     => $line->name()->value(),
            'quantity' => $line->quantity()->value(),
            'price'    => $line->price()->value(),
        ];
    }

}
