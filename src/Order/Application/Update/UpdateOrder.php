<?php

namespace ddd\core\Order\Application\Update;

use ddd\core\Order\Domain\Contracts\OrderRepository;
use Exception;

class UpdateOrder
{

    public function __construct(
        private readonly OrderRepository $repository
    )
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(UpdateOrderRequest $request): void
    {
        $order = $this->repository->findById($request->orderId());

        if (!$order) {
            throw new Exception($request->orderId());
        }

        foreach ($request->orderLines() as $lineData) {
            $order->changeLine(
                $lineData['id'],
                $lineData['name'],
                $lineData['quantity'],
                $lineData['price']
            );
        }

        $this->repository->save($order);
    }


}
