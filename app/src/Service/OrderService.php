<?php

namespace App\Service;

use App\Dto\OrderCreateDto;
use App\Entity\Cart;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Enum\OrderStatus;
use App\Repository\CartRepository;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderService
{
    public function __construct(
        private CartRepository $cartRepository,
        private EntityManagerInterface $entityManager,
        private OrderRepository $orderRepository,
    ) {
    }
    public function createOrderFromCart(int $userId, OrderCreateDto $orderCreateDto): int
    {
        $cart = $this->cartRepository->findOneBy(['user' => $userId]);
        if(!$cart instanceof Cart){
            throw new NotFoundHttpException('cart does not exists');
        }
        $order = null;
        $this->entityManager->wrapInTransaction(
        /**
         * @throws OptimisticLockException
         * @throws ORMException
         */ function () use($cart, $orderCreateDto, &$order){
            $order = new Order();
            $this->entityManager->persist($order);
            $order->setUser($cart->getUser());
            $order->setStatus(OrderStatus::PENDING);
            $order->setName($orderCreateDto->name);
            $order->setSecondName($orderCreateDto->secondName);
            $order->setPhoneNumber($orderCreateDto->phoneNumber);
            $order->setAddress($orderCreateDto->address);
            foreach ($cart->getItems() as $item){
                $orderItem = new OrderItem();
                $this->entityManager->persist($orderItem);
                $orderItem->setProduct($item->getProduct());
                $orderItem->setAmount($item->getAmount());
                $orderItem->setPrice($item->getProduct()->getPrice());
                $order->addItem($orderItem);
            }
            $this->entityManager->remove($cart);
            $this->entityManager->flush();
        });
        if($order === null){
            throw new \Exception('something went wrong');
        }
        return $order->getId();
    }

    public function show(int $orderId){
        $order = $this->orderRepository->find($orderId);
        if(!$order instanceof Order){
            throw new NotFoundHttpException('order does not exist');
        }
        return $order;
    }
    public function cancel($orderId){
        $order = $this->orderRepository->find($orderId);
        if(!$order instanceof Order){
            throw new NotFoundHttpException('order does not exists');
        }
        $order->setStatus(OrderStatus::CANCELLED);
        $this->entityManager->flush();
    }
    public function showAll(int $userId){
        $orders = $this->orderRepository->findBy(['user' => $userId]);
        return $orders;
    }
}
