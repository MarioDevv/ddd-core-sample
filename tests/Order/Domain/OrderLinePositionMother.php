<?php

namespace ddd\core\tests\Order\Domain;

use ddd\core\Order\Domain\OrderLinePosition;

class OrderLinePositionMother
{

    public static function random(?int $value = null): OrderLinePosition
    {
        return new OrderLinePosition($value ?? rand(1, 100));
    }
}
