<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class ProductChangeDto
{
    public function __construct(
        #[Assert\NotBlank]
        public string $name,

        #[Assert\NotBlank]
        public string $description,

        #[Assert\NotBlank]
        #[Assert\GreaterThan(value: 0)]
        public string $price,
    ) {
    }
}
