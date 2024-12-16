<?php

namespace ddd\core\Order\Application\Create;

use ddd\core\Order\Domain\Order;
use ddd\core\Order\Domain\OrderLine;

class CreateOrderResponse
{


    public function __construct(
        private readonly Order $order
    )
    {
    }

    public function json(): array
    {
        return [
            'id' => $this->order->id()
        ];
    }

}
