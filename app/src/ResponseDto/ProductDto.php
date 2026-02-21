<?php

namespace App\ResponseDto;

use App\Enum\ProductStatus;

class ProductDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $slug,
        public string $price,
        public string $description,
        public ProductStatus $status,
        public int $quantity,
    ) {
    }
}
