<?php

namespace App\Controller;

use App\Service\CityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class CityController extends AbstractController
{
    #[Route('/cities', name: 'cities_all', methods: ['GET'])]
    public function showAll(CityService $cityService): JsonResponse
    {
        return $this->json($cityService->showAll());
    }
}
