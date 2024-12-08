<?php

namespace ddd\core\Order\Domain;

class OrderLine
{

    public function __construct(
        private readonly int      $id,
        private OrderLineName     $name,
        private OrderLineQuantity $quantity,
        private OrderLinePrice    $price
    )
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): OrderLineName
    {
        return $this->name;
    }

    public function quantity(): OrderLineQuantity
    {
        return $this->quantity;
    }

    public function price(): OrderLinePrice
    {
        return $this->price;
    }

    public function changeName(string $name): void
    {
        $this->name = new OrderLineName($name);
    }

    public function changeQuantity(int $quantity): void
    {
        $this->quantity = new OrderLineQuantity($quantity);
    }

    public function changePrice(float $price): void
    {
        $this->price = new OrderLinePrice($price);
    }


    public function total(): int
    {
        return $this->quantity->value() * $this->price->value();
    }

    public function equals(OrderLine $other): bool
    {
        return $this->id === $other->id()
            && $this->name->equals($other->name())
            && $this->quantity->equals($other->quantity())
            && $this->price->equals($other->price());
    }
}
