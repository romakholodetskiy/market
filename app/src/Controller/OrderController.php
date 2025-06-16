<?php

namespace App\Controller;

use App\Dto\OrderCreateDto;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\User;
use App\ResponseDto\OrderDtoFactory;
use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class OrderController extends AbstractController
{
    /**
     * @throws \Exception
     */
    #[Route('/orders', name: 'create_order', methods: ['POST'])]
    public function create(#[MapRequestPayload] OrderCreateDto $orderCreateDto, OrderService $orderService): JsonResponse
    {
       /** @var User $user */
       $user = $this->getUser();
       $id = $orderService->createOrderFromCart($user->getId(), $orderCreateDto);
       return $this->json(['id' => $id]);
    }

    #[Route('/orders/{orderId}', name: 'show_order', methods: ['GET'])]
    public function show(int $orderId, OrderService $orderService, OrderDtoFactory $orderDtoFactory): JsonResponse
    {
       $order =  $orderService->show($orderId);
       return $this->json($orderDtoFactory->create($order), Response::HTTP_OK);
    }
    #[Route('/orders', name: 'show_all_order', methods: ['GET'])]
    public function showAll(OrderService $orderService, OrderDtoFactory $orderDtoFactory): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();
        $orders = $orderService->showAll($user->getId());
        $result = array_map(function (Order $order) use ($orderDtoFactory){
            return $orderDtoFactory->create($order);
        },$orders);
        return $this->json($result, Response::HTTP_OK);
    }

    #[Route('/orders/{orderId}', name: 'delete_order', methods: ['DELETE'])]
    public function delete(int $orderId, OrderService $orderService,): JsonResponse
    {
       $orderService->cancel($orderId);
       return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}
