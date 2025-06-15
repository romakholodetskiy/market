<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CartItemAddDto
{
    public function __construct(
        #[Assert\NotBlank]
        public int $productId,
    ) {
    }
}
