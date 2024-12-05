<?php

namespace ddd\core\tests\Order\Domain;

use ddd\core\Order\Domain\OrderLineName;
use ddd\core\tests\Common\Domain\Word;

class OrderLineNameMother
{
    public static function random(?string $value = null): OrderLineName
    {
        return new OrderLineName($value ?? Word::random());
    }
}
