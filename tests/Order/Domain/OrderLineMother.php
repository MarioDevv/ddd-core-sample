<?php

namespace ddd\core\tests\Order\Domain;

use ddd\core\Order\Domain\OrderLine;
use ddd\core\tests\Common\Domain\Number;
use ddd\core\tests\Common\Domain\Word;

class OrderLineMother
{

    public static function random(): OrderLine
    {
        return new OrderLine(
            Number::random(),
            OrderLineNameMother::random(),
            OrderLineQuantityMother::random(),
            OrderLinePriceMother::random(),
        );
    }


}
