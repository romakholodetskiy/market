<?php

namespace App\Controller;

use App\Dto\UserRegisterDto;
use App\Dto\UserTokenDto;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    /**
     * @throws \Exception
     */
    #[Route('/users', name: 'user_registration', methods: ['POST'])]
    public function register(
        #[MapRequestPayload] UserRegisterDto $userRegisterDto,
        UserService $userService,
    ): JsonResponse {
        $id = $userService->register($userRegisterDto);
        return $this->json(['id' => $id]);
    }

    #[Route('/users/token', name: 'login', methods: ['POST'])]
    public function login(
        #[MapRequestPayload] UserTokenDto $userTokenDto,
        UserService $userService,
    ): JsonResponse {
        $token = $userService->login($userTokenDto);
        return $this->json(['token' => $token]);
    }
}
