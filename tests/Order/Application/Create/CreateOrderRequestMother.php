<?php

namespace ddd\core\tests\Order\Application\Create;

use ddd\core\Order\Application\Create\CreateOrderRequest;
use ddd\core\tests\Common\Domain\Number;
use ddd\core\tests\Common\Domain\Word;

class CreateOrderRequestMother
{

    public static function random(): CreateOrderRequest
    {
        return new CreateOrderRequest(
            Number::random(),
            self::randomLines()
        );
    }

    private static function randomLines(): array
    {
        $lines = [];

        for ($i = 0; $i < rand(1, 5); $i++) {
            $lines[] = [
                'name' => Word::random(),
                'quantity' => Number::random(),
                'price' => Number::random()
            ];
        }

        return $lines;

    }

}
