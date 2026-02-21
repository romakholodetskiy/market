<?php

namespace App\Service;

use App\RequestDto\UserRegisterDto;
use App\RequestDto\UserTokenDto;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $hasher,
        private EntityManagerInterface $em,
        private JWTTokenManagerInterface $JWTTokenManager,
    ) {
    }

    public function register(UserRegisterDto $userRegisterDto): int
    {
        if ($this->userRepository->findOneBy(['email' => $userRegisterDto->email]) instanceof User) {
            throw new \Exception('email already exist');
        }
        $user = new User();
        $passwordHash = $this->hasher->hashPassword($user, $userRegisterDto->password);
        $user->setEmail($userRegisterDto->email);
        $user->setName($userRegisterDto->name);
        $user->setSecondName($userRegisterDto->secondName);
        $user->setPassword($passwordHash);
        $this->em->persist($user);
        $this->em->flush();
        return $user->getId();
    }

    public function login(UserTokenDto $userTokenDto): string
    {
        $user = $this->userRepository->findOneBy(['email' => $userTokenDto->email]);
        if (!$user instanceof User) {
            throw new \Exception('invalid email or password');
        }
        if (!$this->hasher->isPasswordValid($user, $userTokenDto->password)) {
            throw new \Exception('invalid email or password');
        }
        return $this->JWTTokenManager->create($user);
    }
}
