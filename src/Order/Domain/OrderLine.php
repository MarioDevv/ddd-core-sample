<?php

namespace ddd\core\Order\Domain;

class OrderLine
{

    private int $surrogateId;

    public function __construct(
        private OrderLineName     $name,
        private OrderLineQuantity $quantity,
        private OrderLinePrice    $price,
        private OrderLinePosition $position
    )
    {
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

    public function position(): OrderLinePosition
    {
        return $this->position;
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

    public static function create(string $name, int $quantity, float $price, int $position): OrderLine
    {
        return new OrderLine(
            new OrderLineName($name),
            new OrderLineQuantity($quantity),
            new OrderLinePrice($price),
            new OrderLinePosition($position)
        );
    }

    public function equals(OrderLine $other): bool
    {
        return $this->name->equals($other->name())
            && $this->quantity->equals($other->quantity())
            && $this->price->equals($other->price())
            && $this->position->equals($other->position());
    }
}
