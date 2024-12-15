<?php

namespace ddd\core\Order\Domain;

class OrderLine
{

    public function __construct(
        private readonly int      $id,
        private readonly int      $orderId,
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

    public function orderId(): int
    {
        return $this->orderId;
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

    public static function create(int $id, int $orderId, string $name, int $quantity, float $price): OrderLine
    {
        return new OrderLine(
            $id,
            $orderId,
            new OrderLineName($name),
            new OrderLineQuantity($quantity),
            new OrderLinePrice($price)
        );
    }

    public function equals(OrderLine $other): bool
    {
        return $this->id === $other->id()
            && $this->name->equals($other->name())
            && $this->quantity->equals($other->quantity())
            && $this->price->equals($other->price());
    }
}
