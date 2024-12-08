<?php

namespace ddd\core\tests\Order\Domain;

use ddd\core\Order\Domain\OrderLineQuantity;
use ddd\core\tests\Common\Domain\Number;

class OrderLineQuantityMother
{
    public static function random(?int $value = null): OrderLineQuantity
    {
        return new OrderLineQuantity($value ?? Number::numberBetween(1, 10));
    }
}
