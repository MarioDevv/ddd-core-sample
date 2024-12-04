<?php

namespace ddd\core\tests\Common\Domain;

use Faker\Factory;

class Word
{

    public static function random(?string $value = null): string
    {
        return $value ?? Factory::create()->name();
    }

}
