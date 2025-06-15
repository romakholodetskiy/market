<?php

namespace App\ResponseDto;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Repository\CartRepository;

class CartDtoFactory
{
    public function __construct(
        private CartItemDtoFactory $cartItemDtoFactory,
        private CartRepository $cartRepository,
    )
    {
    }

    public function create(Cart $cart) : CartDto
    {
        $items = $cart->getItems()->map(function (CartItem $cartItem)
        {
            return $this->cartItemDtoFactory->create($cartItem);
        });
        return new CartDto($cart->getId(),$items->toArray(), $this->cartRepository->totalPrice($cart->getId()));
    }
}
