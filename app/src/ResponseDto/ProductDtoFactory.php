<?php

namespace App\ResponseDto;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductDtoFactory
{
    function create(Product $product): ProductDto{
       return new ProductDto(
           $product->getId(),
           $product->getName(),
           $product->getSlug(),
           $product->getPrice(),
           $product->getDescription(),
           $product->getStatus(),
           $product->getQuantity(),
       );
    }

    /**
     * @param Product[] $products
     * @return ProductDto[]
     */
    function createList(array $products): array{
        return array_map(fn($product) => $this->create($product), $products);
    }
}
