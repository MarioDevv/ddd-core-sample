<?php

namespace ddd\core\Order\Application\Update;

class UpdateOrderRequest
{
    public function __construct(
        private int   $orderId,
        private int   $clientId,
        private array $orderLines,
    )
    {
    }

    public function orderId(): int
    {
        return $this->orderId;
    }

    public function clientId(): int
    {
        return $this->clientId;
    }

    public function orderLines(): array
    {
        return $this->orderLines;
    }

}
