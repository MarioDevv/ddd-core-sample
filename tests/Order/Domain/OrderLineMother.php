<?php

namespace ddd\core\tests\Order\Domain;

use ddd\core\Order\Domain\OrderLine;
use ddd\core\tests\Common\Domain\Number;
use ddd\core\tests\Common\Domain\Word;

class OrderLineMother
{

    public static function random(
        ?string $name  = null,
        ?int $quantity = null,
        ?int $price  = null
    ): OrderLine
    {
        return new OrderLine(
            Number::random(),
            OrderLineNameMother::random($name),
            OrderLineQuantityMother::random($quantity),
            OrderLinePriceMother::random($price),
        );
    }


}
