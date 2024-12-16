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
     * @var Collection<int, OrderLine>
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


    /**
     * @return Collection<int, OrderLine>
     */
    public function lines(): Collection
    {
        return $this->orderLines;
    }

    public function addLine(int $id, string $name, int $quantity, float $price): void
    {

        if ($this->orderLines->exists(fn($key) => $key === $id)) {
            return;
        }

        $this->orderLines->set($id, OrderLine::create($id, $name, $quantity, $price));

    }

    public function changeLine(int $id, string $name, int $quantity, float $price): void
    {

        $line = $this->orderLines->get($id);


        if ($line === null) {
            return;
        }

        $line->changeName($name);
        $line->changeQuantity($quantity);
        $line->changePrice($price);

        $this->orderLines->set($id, $line);
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

        foreach ($this->orderLines as $id => $line) {
            if (!$line->equals($lines->get($id))) {
                return false;
            }
        }

        return true;
    }

}
