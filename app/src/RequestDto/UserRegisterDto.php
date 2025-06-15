<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

readonly class UserRegisterDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 2, max: 100)]
        public string $name,

        #[Assert\NotBlank]
        #[Assert\Length(min: 2, max: 100)]
        public string $secondName,

        #[Assert\NotBlank]
        #[Assert\Email]
        public string $email,

        #[Assert\NotBlank]
        #[Assert\Length(min: 5, max: 100)]
        public string $password,
    ) {
    }
}
