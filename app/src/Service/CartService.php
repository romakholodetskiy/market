<?php

namespace App\Service;

use App\RequestDto\CartItemAddDto;
use App\RequestDto\CartItemUpdateDto;
use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\CartItemRepository;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CartService
{
    public function __construct(
        private CartRepository $cartRepository,
        private EntityManagerInterface $entityManager,
        private CartItemRepository $cartItemRepository,
        private ProductRepository $productRepository,
    ) {
    }

    public function addItem(User $user, CartItemAddDto $cartItemAddDto): int
    {
        $cart = $this->cartRepository->findOneBy(['user' => $user]);
        if (!$cart instanceof Cart) {
            $cart = new Cart;
            $cart->setUser($user);
            $this->entityManager->persist($cart);
        }
        if ($cart->getId() !== null) {
            $cartItem = $this->cartItemRepository->findOneBy([
                'cart' => $cart->getId(),
                'product' => $cartItemAddDto->productId,
            ]);
            if ($cartItem instanceof CartItem) {
                return $cartItem->getId();
            }
        }
        $product = $this->productRepository->find($cartItemAddDto->productId);
        if (!$product instanceof Product) {
            throw new NotFoundHttpException('product does not exists');
        }
        $cartItem = new CartItem();
        $cart->addItem($cartItem);
        $cartItem->setProduct($product);
        $cartItem->setAmount(1);
        $this->entityManager->persist($cartItem);
        $this->entityManager->flush();
        return $cartItem->getId();
    }
    public function updateItem(int $id, CartItemUpdateDto $cartItemUpdateDto){
        $cartItem = $this->cartItemRepository->find($id);
        if(!$cartItem instanceof CartItem){
            throw new NotFoundHttpException('Cart item does not exists');
        }
        $cartItem->setAmount($cartItemUpdateDto->amount);
        $this->entityManager->flush();
        return $cartItem;
    }
    public function deleteItem(int $id){
        $cartItem = $this->cartItemRepository->find($id);
        if(!$cartItem instanceof CartItem){
            return ;
        }
        $this->entityManager->remove($cartItem);
        $this->entityManager->flush();
    }
    public function show($userId){
        $cart = $this->cartRepository->findOneBy(['user' => $userId]);
        if(!$cart instanceof Cart){
            return null;
        }
        return $cart;
    }
}
