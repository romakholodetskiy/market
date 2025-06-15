<?php

namespace App\Service;

use App\Dto\ProductChangeDto;
use App\Dto\ProductCreateDto;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use mysql_xdevapi\Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductService
{
    public function __construct(
        private ProductRepository $productRepository,
        private EntityManagerInterface $em,
        private SluggerInterface $slugger,
    ) {
    }

    public function create(ProductCreateDto $productCreateDto): int
    {
        $slug = $this->slugger->slug($productCreateDto->name);
        if ($this->productRepository->findOneBy(['slug' => $slug->toString()])) {
            throw new NotFoundHttpException('product with this name already exists');
        }
        $product = new Product();
        $product->setName($productCreateDto->name);
        $product->setPrice($productCreateDto->price);
        $product->setSlug($slug);
        $product->setDescription($productCreateDto->description);
        $this->em->persist($product);
        $this->em->flush();
        return $product->getId();
    }

    public function showAll(): array
    {
        return $this->productRepository->findAll();
    }

    public function show(int $id): Product
    {
        $product = $this->productRepository->find($id);
        if (!$product) {
            throw new NotFoundHttpException('product does not exists');
        }
        return $product;
    }
    public function delete(int $id) : void
    {
        $product = $this->productRepository->find($id);
        if (!$product) {
            return ;
        }
        $this->em->remove($product);
        $this->em->flush();
    }
    public function change(int $id, ProductChangeDto $productChangeDto){
        $product = $this->productRepository->find($id);
        if(!$product instanceof Product){
            throw new NotFoundHttpException('product does not exists');
        }
        $slug = $this->slugger->slug($productChangeDto->name);
        $product->setName($productChangeDto->name);
        $product->setDescription($productChangeDto->description);
        $product->setPrice($productChangeDto->price);
        $product->setSlug($slug);
        $this->em->flush();
        return $product;
    }
}
