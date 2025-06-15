<?php

namespace App\ResponseDto;

use App\Entity\CartItem;

readonly class CartItemDto implements \JsonSerializable
{
    public function __construct(
        public int $id,
        public int $amount,
        public int $productId,
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'productId' => $this->productId,
            ];
    }
}
