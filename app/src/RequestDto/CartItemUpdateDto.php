<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CartItemUpdateDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\GreaterThan(value: 0)]
        public int $amount,
    ) {
    }
}
