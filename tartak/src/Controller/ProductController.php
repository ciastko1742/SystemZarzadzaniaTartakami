<?php


namespace App\Controller;


use App\Repository\MaterialRepository;
use App\Repository\TransportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
            'products'=>$materialRepository->findAll()
        ]);
    }

    /**
     * @Route("/product/search", name="productSearch")
     */
    public function searchProduct(Request $request, MaterialRepository $materialRepository)
    {
        $text = $request->request->get('text');

        return $this->render('product/product_list.html.twig',
            [
                'products'=>$materialRepository->findByText($text)
            ]);
    }


}