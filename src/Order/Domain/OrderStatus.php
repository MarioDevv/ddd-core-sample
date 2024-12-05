<?php

namespace ddd\core\Order\Domain;

class OrderStatus
{

    public const PENDING = 1;
    public const CONFIRMED = 2;
    public const SHIPPED = 3;

    public function __construct(private readonly int $value)
    {
        $this->ensureIsValidStatus($value);
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(OrderStatus $other): bool
    {
        return $this->value() === $other->value();
    }

    private function ensureIsValidStatus(int $value): void
    {
        if (!in_array($value, [self::PENDING, self::CONFIRMED, self::SHIPPED])) {
            throw new \InvalidArgumentException('Invalid status');
        }
    }

}
