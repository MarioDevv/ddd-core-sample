<?php

namespace ddd\core\tests\Order\Application\Update;

use ddd\core\Order\Application\Update\UpdateOrderRequest;
use ddd\core\tests\Common\Domain\Number;
use ddd\core\tests\Common\Domain\Word;

class UpdateOrderRequestMother
{

    public static function random(): UpdateOrderRequest
    {
        return new UpdateOrderRequest(
            Number::random(),
            Number::random(),
            self::randomLines()
        );
    }

    private static function randomLines(): array
    {
        $lines = [];

        for ($i = 0; $i < rand(1, 5); $i++) {
            $lines[] = [
                'id'       => Number::random(),
                'name'     => Word::random(),
                'quantity' => Number::numberBetween(1, 3),
                'price'    => Number::numberBetween(500, 2000)
            ];
        }

        return $lines;

    }

}
