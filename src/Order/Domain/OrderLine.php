<?php

namespace ddd\core\Order\Domain;

class OrderLine
{

    public function __construct(
        private readonly int $id,
        private string       $name,
        private int          $quantity,
        private float        $price
    )
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function changeName(string $name): void
    {
        $this->name = $name;
    }

    public function changeQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function changePrice(float $price): void
    {
        $this->price = $price;
    }


    public function total(): float
    {
        return $this->price * $this->quantity;
    }

    public function equals(OrderLine $lineToCompare): bool
    {
        return $this->id === $lineToCompare->id()
            && $this->name === $lineToCompare->name()
            && $this->quantity === $lineToCompare->quantity()
            && $this->price === $lineToCompare->price();
    }
}
