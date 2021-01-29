<?php

namespace App\Controller;

use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class OrderController extends AbstractController
{
    /**
     * @Route("/admin/orders", name="admin_order_list")
     * @isGranted("ROLE_ADMIN")
     */
    public function index(): Response
    {
        $all = $this->getDoctrine()->getRepository(Order::class)->findAll();

        return $this->render('order/index.html.twig', [
            'orders' => $all
        ]);
    }

    /**
     * @Route("/order", name="user_order_list")
     */
    public function userOrderList(): Response
    {
        $all = $this->getDoctrine()->getRepository(Order::class)->findOrdersByUsers($this->getUser());

        return $this->render('order/index.html.twig', [
            'orders' => $all
        ]);
    }
}
