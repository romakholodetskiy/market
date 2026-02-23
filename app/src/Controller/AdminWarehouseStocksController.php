<?php

namespace App\Controller;

use App\Repository\WarehouseStockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class AdminWarehouseStocksController extends AbstractController
{
    #[Route('/admin/warehouse-stocks', name: 'app_warehouse_stocks')]
    public function index(WarehouseStockRepository $warehouseStockRepository): JsonResponse
    {
       return $this->json($warehouseStockRepository->findAll());
    }
}
