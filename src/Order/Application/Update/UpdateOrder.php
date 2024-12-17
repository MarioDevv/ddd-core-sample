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

        // Eliminamos todas las líneas de pedido para volver a crearlas
        $order->clearLines();

        foreach ($request->orderLines() as $line) {
            $order->addLine($line['name'], $line['quantity'], $line['price']);
        }

        $this->repository->save($order);
    }


}
