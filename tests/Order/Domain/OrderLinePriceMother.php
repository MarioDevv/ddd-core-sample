<?php

namespace ddd\core\tests\Order\Domain;

use ddd\core\Order\Domain\OrderLinePrice;
use ddd\core\tests\Common\Domain\Number;

class OrderLinePriceMother
{

    public static function random(?float $value = null): OrderLinePrice
    {
        return new OrderLinePrice($value ?? Number::numberBetween(500, 2000));
    }

}
