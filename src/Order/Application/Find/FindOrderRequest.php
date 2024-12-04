<?php

namespace ddd\core\Order\Application\Find;

class FindOrderRequest
{

    public function __construct(
        private readonly int $id
    )
    {
    }

    public function id(): int
    {
        return $this->id;
    }

}
