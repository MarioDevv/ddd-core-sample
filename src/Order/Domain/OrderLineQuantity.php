<?php

namespace ddd\core\Order\Domain;

class OrderLineQuantity
{

    public function __construct(private readonly int $value)
    {
        $this->ensureQuantityIsGreaterThanZero($value);
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(OrderLineQuantity $other): bool
    {
        return $this->value() === $other->value();
    }

    private function ensureQuantityIsGreaterThanZero(int $value): void
    {
        if ($value <= 0) {
            throw new \InvalidArgumentException('Quantity must be greater than zero');
        }
    }

}
