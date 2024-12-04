<?php

namespace ddd\core\tests\Common\Infrastructure;

use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;

abstract class PhpUnitTestCase extends MockeryTestCase
{

    protected function mock(string $className): MockInterface
    {
        return Mockery::mock($className);
    }
}
