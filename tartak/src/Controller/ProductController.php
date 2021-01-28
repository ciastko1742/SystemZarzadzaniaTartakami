<?php


namespace App\Controller;


use App\Repository\MaterialRepository;
use App\Repository\TransportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProductController extends AbstractController
{
    /**
     * @Route("/welcome", name="welcome")
     */
    public function index(MaterialRepository $materialRepository, TransportRepository $transportRepository):Response{
        return $this->render('product/index.html.twig',
        [
            'products'=>$materialRepository->findAll(),
            'transports'=>$transportRepository->findAll()
        ]);
    }



}