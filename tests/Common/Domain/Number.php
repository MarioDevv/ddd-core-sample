<?php

namespace ddd\core\tests\Common\Domain;

use Faker\Factory;

class Number
{

    public static function random(?int $value = null): string
    {
        return $value ?? Factory::create()->randomNumber();
    }

    public static function numberBetween(int $min, int $max = PHP_INT_MAX): int
    {
        return Factory::create()->numberBetween($min, $max);
    }

}
