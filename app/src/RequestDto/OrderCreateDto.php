<?php

namespace App\RequestDto;

use Symfony\Component\Validator\Constraints as Assert;

class OrderCreateDto
{
    public function __construct(
        #[Assert\NotBlank]
        public string $name,
        #[Assert\NotBlank]
        public string $secondName,
        #[Assert\NotBlank]
        public string $phoneNumber,
        #[Assert\NotBlank]
        public string $address,
        #[Assert\NotBlank]
        #[Assert\Positive]
        public int $cityId,
    ) {
    }
}
