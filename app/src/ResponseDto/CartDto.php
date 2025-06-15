<?php

namespace App\ResponseDto;

class CartDto implements \JsonSerializable
{
    /**
     * @param CartItemDto[] $items
     */
    public function __construct(
        public int $id,
        public array $items,
        public string $total,
    )
    {
    }

    public function jsonSerialize(): array
    {
        return [
          'id' => $this->id,
          'items' => $this->items,
          'total' => $this->total,
        ];
    }
}
