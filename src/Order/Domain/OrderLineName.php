<?php

namespace ddd\core\Order\Domain;

class OrderLineName
{

    public function __construct(private readonly string $value)
    {
        $this->ensureNameIsNotEmpty($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(OrderLineName $nameToCompare): bool
    {
        return $this->value === $nameToCompare->value();
    }

    private function ensureNameIsNotEmpty(string $value): void
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('Name cannot be empty');
        }
    }

}
