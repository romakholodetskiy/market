<?php

namespace App\ResponseDto;

use App\Entity\OrderItem;

class OrderItemDtoFactory
{
    public function create(OrderItem $orderItem): OrderItemDto
    {
        return new OrderItemDto(
            $orderItem->getId(),
            $orderItem->getProduct()->getId(),
            $orderItem->getAmount(),
            $orderItem->getPrice()
        );
    }
}
