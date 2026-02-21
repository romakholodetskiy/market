<?php

namespace App\RequestDto;

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
