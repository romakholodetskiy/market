<?php

namespace App\ResponseDto;

class OrderDto implements \JsonSerializable
{
    public function __construct(
        public int $id,
        public int $userId,
        public int $status,
        public string $name,
        public string $secondName,
        public string $address,
        public string $phoneNumber,
        public array $items,
        public string $totalPrice,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'user' => $this->userId,
            'status' => $this->status,
            'name' => $this->name,
            'secondName' => $this->secondName,
            'address' => $this->address,
            'phoneNumber' => $this->phoneNumber,
            'items' => $this->items,
            'totalPrice' => $this->totalPrice,
        ];
    }
}
