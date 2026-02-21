<?php

namespace App\RequestDto;

use Symfony\Component\Validator\Constraints as Assert;

class CartItemAddDto
{
    public function __construct(
        #[Assert\NotBlank]
        public int $productId,
    ) {
    }
}
