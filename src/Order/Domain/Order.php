<?php

namespace ddd\core\Order\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Order
{

    private int $id;
    private int $clientId;
    private OrderStatus $status;

    /**
     * @var Collection<OrderLine>
     */
    private Collection $orderLines;

    public function __construct(
        int         $id,
        int         $clientId,
        OrderStatus $status
    )
    {
        $this->id         = $id;
        $this->clientId   = $clientId;
        $this->status     = $status;
        $this->orderLines = new ArrayCollection();
    }

    public function id(): int
    {
        return $this->id;
    }

    public function clientId(): int
    {
        return $this->clientId;
    }

    public function status(): OrderStatus
    {
        return $this->status;
    }


    public function lines(): Collection
    {
        return $this->orderLines;
    }

    public function addLine(string $name, int $quantity, float $price): void
    {
        $nextPosition = $this->orderLines->count() + 1;

        $this->orderLines->add(OrderLine::create($name, $quantity, $price, $nextPosition));
    }

    public function changeLine(string $name, int $quantity, float $price, int $position): void
    {
        $line = $this->orderLines->filter(fn(OrderLine $line) => $line->position()->value() === $position)->first();

        if ($line === false) {
            throw new \InvalidArgumentException("Line with position $position not found");
        }

        $line->changeName($name);
        $line->changeQuantity($quantity);
        $line->changePrice($price);
    }

    public function total(): float
    {
        $total = 0;

        foreach ($this->orderLines as $line) {
            $total += $line->total();
        }

        return $total / 100;
    }

    public function equals(Order $other): bool
    {
        return $this->id === $other->id()
            && $this->clientId === $other->clientId()
            && $this->status->equals($other->status())
            && $this->hasSameLines($other->lines());
    }

    private function hasSameLines(Collection $lines): bool
    {
        if (count($this->orderLines) !== count($lines)) {
            return false;
        }

        foreach ($this->orderLines as $line) {
            $matchingLine = $lines->filter(fn(OrderLine $otherLine) => $line->equals($otherLine))->first();
            if ($matchingLine === false) {
                return false;
            }
        }

        return true;
    }

}
