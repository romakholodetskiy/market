<?php

namespace App\Controller;

use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class AdminCityController extends AbstractController
{
    #[Route('/admin/cities', name: 'app_admin_city')]
    public function index(CityRepository $cityRepository): JsonResponse
    {
        return $this->json($cityRepository->findAll());
    }
}
