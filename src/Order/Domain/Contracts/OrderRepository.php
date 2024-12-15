<?php

namespace ddd\core\Order\Domain\Contracts;

use ddd\core\Order\Domain\Order;

interface OrderRepository
{
    public function nextOrderIdentity(): int;
    public function nextOrderLineIdentity():int;
    public function findById(int $id): ?Order;
    public function save(Order $order): void;

    // ...

}
