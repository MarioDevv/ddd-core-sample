<?php
declare(strict_types=1);

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
    private Collection $lines;

    public function __construct(
        int         $id,
        int         $clientId,
        OrderStatus $status
    )
    {
        $this->id       = $id;
        $this->clientId = $clientId;
        $this->status   = $status;
        $this->lines    = new ArrayCollection();
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


    public function lines(): array
    {
        return $this->lines->toArray();
    }

    public function addLine(string $name, int $quantity, float $price): void
    {
        $this->lines->add(OrderLine::create($name, $quantity, $price));
    }

    public function clearLines(): void
    {
        $this->lines->clear();
    }

    public function total(): float
    {
        $total = 0;

        foreach ($this->lines as $line) {
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
        if (count($this->lines) !== count($lines)) {
            return false;
        }

        foreach ($this->lines as $line) {
            if (!$this->hasLine($line, $lines)) {
                return false;
            }
        }

        return true;
    }

    private function hasLine(OrderLine $line, array $lines): bool
    {
        foreach ($lines as $otherLine) {
            if ($line->equals($otherLine)) {
                return true;
            }
        }

        return false;
    }

}
