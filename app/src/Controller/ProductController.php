<?php

namespace App\Controller;

use App\RequestDto\ProductChangeDto;
use App\RequestDto\ProductCreateDto;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    /**
     * @throws \Exception
     */
    #[Route('/products', name: 'products_create', methods: ['POST'])]
    public function create(#[MapRequestPayload] ProductCreateDto $productCreateDto,ProductService $productService): JsonResponse
    {
        $id = $productService->create($productCreateDto);
        return $this->json(['id' => $id], Response::HTTP_CREATED);
    }
    #[Route('/products', name: 'products_all', methods: ['GET'])]
    public function showAll(ProductService $productService): JsonResponse
    {
        return $this->json($productService->showAll());
    }
    #[Route('/products/{id}', name: 'product_show', methods: ['GET'])]
    public function show(int $id, ProductService $productService) : JsonResponse
    {
        $product = $productService->show($id);
        return $this->json($product);
    }
    #[Route('/products/{id}', name: 'product_delete', methods: ['DELETE'])]
    public function delete(int $id, ProductService $productService){
        $productService->delete($id);
        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
    #[Route('/products/{id}', name: 'product_change', methods: ['PUT'])]
    public function change(int $id,#[MapRequestPayload] ProductChangeDto $productChangeDto, ProductService $productService){
        $product = $productService->change($id, $productChangeDto);
        return $this->json($product, Response::HTTP_OK);
    }
}
