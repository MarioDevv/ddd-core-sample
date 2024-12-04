<?php

namespace ddd\core\Order\Application\Find;

use ddd\core\Order\Domain\Contracts\OrderRepository;
use Exception;

class FindOrder
{

    public function __construct(
        private readonly OrderRepository $repository
    )
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(FindOrderRequest $request): FindOrderResponse
    {

        $order = $this->repository->findById($request->id());

        if (!$order) {
            throw new Exception();
        }

        return new FindOrderResponse($order);
    }

}
