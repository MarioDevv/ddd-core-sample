<?php

namespace ddd\core\tests\Order\Domain;

use ddd\core\Order\Domain\OrderStatus;
use ddd\core\tests\Common\Domain\Number;

class OrderStatusMother
{

    public static function random(?int $value = null)
    {
        return new OrderStatus($value ?? Number::numberBetween(1, 3));
    }

}
