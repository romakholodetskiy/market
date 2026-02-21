<?php

namespace App\Controller;

use App\RequestDto\CartItemAddDto;
use App\RequestDto\CartItemUpdateDto;
use App\Entity\User;
use App\ResponseDto\CartDtoFactory;
use App\ResponseDto\CartItemDtoFactory;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class CartController extends AbstractController
{
    #[Route('/cart/items', name: 'add_to_cart', methods: ['POST'])]
    public function addItem(#[MapRequestPayload] CartItemAddDto $cartItemAddDto, CartService $cartService): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();
        $cartItemId = $cartService->addItem($user, $cartItemAddDto);
        return $this->json(['id' => $cartItemId], Response::HTTP_CREATED);
    }

    #[Route('/cart/items/{id}', name: 'cart_update', methods: ['PUT'])]
    public function updateItem(
        int $id,
        #[MapRequestPayload] CartItemUpdateDto $cartItemAddDto,
        CartService $cartService,
        CartItemDtoFactory $cartItemDtoFactory,
    ): JsonResponse {
        $cartItem = $cartService->updateItem($id, $cartItemAddDto);
        return $this->json($cartItemDtoFactory->create($cartItem), Response::HTTP_OK);
    }

    #[Route('/cart/items/{id}', name: 'cart_delete', methods: ['DELETE'])]
    public function deleteItem(int $id, CartService $cartService): JsonResponse
    {
        $cartService->deleteItem($id);
        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
    #[Route('/cart', name: 'cart_get', methods: ['GET'])]
    public function show(CartService $cartService, CartDtoFactory $cartDtoFactory): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();
        $cart = $cartService->show($user->getId());
        if ($cart === null) {
            return $this->json(['id' => null, 'items' => [], 'total' => 0], Response::HTTP_OK);
        }
        return $this->json($cartDtoFactory->create($cart), Response::HTTP_OK);
    }
}
