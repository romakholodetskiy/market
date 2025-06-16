<?php

namespace App\ResponseDto;

use App\Entity\CartItem;

class CartItemDtoFactory
{
    public function create(CartItem $cartItem) : CartItemDto
    {
        return new CartItemDto(
            $cartItem->getId(),
            $cartItem->getAmount(),
            $cartItem->getProduct()->getId(),
            $cartItem->getProduct()->getName(),
        );
    }
}
