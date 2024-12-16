<?php

namespace ddd\core\Order\Domain;

class OrderLinePosition
{

    public function __construct(private readonly int $value)
    {
        $this->ensureIsValidPosition($value);
    }

    public function value(): int
    {
        return $this->value;
    }

    private function ensureIsValidPosition(int $value): void
    {
        if ($value <= 0) {
            throw new \InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s> to be less than or equal to 0',
                    static::class,
                    $value
                )
            );
        }
    }

    public function equals(OrderLinePosition $other): bool
    {
        return $this->value() === $other->value();
    }


}
