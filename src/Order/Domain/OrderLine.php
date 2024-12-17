<?php
declare(strict_types=1);

namespace ddd\core\Order\Domain;

class OrderLine
{

    private int $surrogateId;

    public function __construct(
        private OrderLineName     $name,
        private OrderLineQuantity $quantity,
        private OrderLinePrice    $price,
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

    public function total(): int
    {
        return $this->quantity->value() * $this->price->value();
    }

    public static function create(string $name, int $quantity, float $price): OrderLine
    {
        return new OrderLine(
            new OrderLineName($name),
            new OrderLineQuantity($quantity),
            new OrderLinePrice($price),
        );
    }

    public function equals(OrderLine $other): bool
    {
        return $this->name->equals($other->name())
            && $this->quantity->equals($other->quantity())
            && $this->price->equals($other->price());
    }
}
