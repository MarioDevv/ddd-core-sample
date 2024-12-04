<?php

namespace ddd\core\tests\Order\Application\Find;

use ddd\core\Order\Application\Find\FindOrderRequest;
use ddd\core\tests\Common\Domain\Number;

class FindOrderRequestMother
{

    public static function random(): FindOrderRequest
    {
        return new FindOrderRequest(
            Number::random()
        );
    }

}
