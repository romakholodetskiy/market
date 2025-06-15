<?php

namespace App\ResponseDto;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Repository\OrderRepository;

class OrderDtoFactory
{
    public function __construct(
        private OrderRepository $orderRepository,
        private OrderItemDtoFactory $orderItemDtoFactory,
    )
    {
    }
    public function create(Order $order)
    {
        $items = $order->getItems()->map(function (OrderItem $orderItem){
            return $this->orderItemDtoFactory->create($orderItem);
        });
        return new OrderDto(
            $order->getId(),
            $order->getUser()->getId(),
            $order->getStatus(),
            $order->getName(),
            $order->getSecondName(),
            $order->getAddress(),
            $order->getPhoneNumber(),
            $items->toArray(),
            $this->orderRepository->totalPrice($order->getId()),
        );
    }
}
