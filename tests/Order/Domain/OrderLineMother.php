<?php

namespace ddd\core\tests\Order\Domain;

use ddd\core\Order\Domain\OrderLine;
use ddd\core\tests\Common\Domain\Number;
use ddd\core\tests\Common\Domain\Word;

class OrderLineMother
{

    public static function random(
        ?int $orderId = null,
        ?string $name  = null,
        ?int $quantity = null,
        ?int $price  = null
    ): OrderLine
    {
        return new OrderLine(
            Number::random(),
            Number::random($orderId),
            OrderLineNameMother::random($name),
            OrderLineQuantityMother::random($quantity),
            OrderLinePriceMother::random($price),
        );
    }


}
