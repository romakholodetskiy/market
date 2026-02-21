<?php

namespace App\ResponseDto;

class OrderItemDto implements \JsonSerializable
{
    public function __construct(
        public int $id,
        public int $productId,
        public int $amount,
        public string $price,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'productId' => $this->productId,
            'amount' => $this->amount,
            'price' => $this->price,
        ];
    }
}
