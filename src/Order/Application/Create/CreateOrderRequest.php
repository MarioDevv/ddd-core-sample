<?php

namespace ddd\core\Order\Application\Create;

class CreateOrderRequest
{

    public function __construct(
        private int $clientId,
        private array $orderLines,
    )
    {
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
