<?php

namespace ddd\core\Order\Domain;

class OrderLinePrice
{

    public function __construct(private readonly float $value)
    {
        $this->ensurePriceIsOverZero($value);
    }

    public function value(): float
    {
        return $this->value;
    }

    public function equals(OrderLinePrice $other): bool
    {
        return $this->value() === $other->value();
    }

    private function ensurePriceIsOverZero(float $value): void
    {
        if ($value <= 0) {
            throw new \InvalidArgumentException('Price must be over zero');
        }
    }


}
