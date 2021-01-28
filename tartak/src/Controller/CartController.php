<?php

namespace App\Controller;

use App\Entity\Calculation;
use App\Entity\Offer;
use App\Repository\MaterialRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(): Response
    {
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }

    /**
     * @Route("/cart/add", name="add_to_cart")
     * @param Request $request
     */
    public function addCart(Request $request, MaterialRepository $materialRepository, EntityManagerInterface $entityManager)
    {
        $calculation = new Calculation();
        $calculation->setHeight($request->request->get('height'));
        $calculation->setWidth($request->request->get('width'));
        $calculation->setWidth($request->request->get('width'));
        $calculation->setQuantity($request->request->get('quantity'));
        $material = $materialRepository->findOneBy(['id'=> $request->request->get('material')]);
        if($material){
            $calculation->setMaterial($material);
        }
        if($price = $calculation->countPrice()){
            $calculation->setPrice($price);
        }

        $offer = new Offer();
        $offer->setCalculation($calculation);
        $offer->setUser($this->getUser());



        try {
            $entityManager->persist($calculation);
            $entityManager->flush();
            //$session->getFlashBag()->add('success', sprintf('Konto użytkownika % zostało pomyślnie stworzone', $user->getFirstname()));
        }catch (UniqueConstraintViolationException $exception) {
            //$session->getFlashBag()->add('danger', 'Podany e-mail już istenieje w bazie systemu');
        }

    }
}
