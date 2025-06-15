<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class UserTokenDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Email]
        public string $email,

        #[Assert\NotBlank]
        #[Assert\Length(min: 5, max: 100)]
        public string $password,
    ) {
    }

}
