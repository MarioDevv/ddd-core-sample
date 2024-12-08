<?php

namespace ddd\core\Order\Domain;

class OrderLinePrice
{
    const MINIMUM_PRICE = 500;

    public function __construct(private readonly int $value)
    {
        $this->ensurePriceIsOverZero($value);
        $this->ensurePriceIsOverMinimumPermitted($value);
    }

    public function value(): int
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

    private function ensurePriceIsOverMinimumPermitted(int $value): void
    {
        if ($value < self::MINIMUM_PRICE) {
            throw new \InvalidArgumentException('Price must be over '. self::MINIMUM_PRICE);
        }
    }


}
