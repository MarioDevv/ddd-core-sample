<?php

namespace ddd\core\Order\Domain;

class Order
{

    /**
     * @param OrderLine[] $orderLines
     */
    public function __construct(
        private readonly int         $id,
        private readonly int         $clientId,
        private readonly OrderStatus $status,
        private array                $orderLines = [],
    )
    {
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


    /**
     * @return OrderLine[]
     */
    public function lines(): array
    {
        return $this->orderLines;
    }

    public function addLine(int $id, int $orderId, string $name, int $quantity, float $price): void
    {
        $this->orderLines[$id] = new OrderLine(
            $id,
            $orderId,
            new OrderLineName($name),
            new OrderLineQuantity($quantity),
            new OrderLinePrice($price),
        );
    }

    public function changeLine(int $id, string $name, int $quantity, float $price): void
    {
        if (!isset($this->orderLines[$id])) {
            return;
        }

        $line = $this->orderLines[$id];

        $line->changeName($name);
        $line->changeQuantity($quantity);
        $line->changePrice($price);

        $this->orderLines[$id] = $line;
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

    private function hasSameLines(array $lines): bool
    {
        if (count($this->orderLines)!== count($lines)) {
            return false;
        }

        foreach ($this->orderLines as $id => $line) {
            if (!$line->equals($lines[$id])) {
                return false;
            }
        }

        return true;
    }

}
