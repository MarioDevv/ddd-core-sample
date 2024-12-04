<?php

namespace ddd\core\Order\Domain;

class Order
{

    /**
     * @param OrderLine[] $orderLines
     */
    public function __construct(
        private readonly int $id,
        private readonly int $clientId,
        private array        $orderLines = [],
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

    /**
     * @return OrderLine[]
     */
    public function lines(): array
    {
        return $this->orderLines;
    }

    public function addLine(int $id, string $name, int $quantity, float $price): void
    {
        $this->orderLines[$id] = new OrderLine($id, $name, $quantity, $price);
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

        return $total;
    }

    public function equals(Order $order): bool
    {
        return $this->id === $order->id()
            && $this->clientId === $order->clientId()
            && $this->orderLinesAreEqual($order->lines());
    }

    private function orderLinesAreEqual(array $lines): bool
    {
        return count($this->orderLines) === count($lines)
            && array_reduce(
                array_keys($this->orderLines),
                fn($carry, $id) => $carry && $this->orderLines[$id]->equals($lines[$id]),
                true
            );
    }
}
