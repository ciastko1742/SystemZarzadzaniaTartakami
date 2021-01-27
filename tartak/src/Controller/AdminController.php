<?php

namespace App\Controller;

use App\Entity\Material;
use App\Form\MaterialType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/newProduct", name="add_new_product")
     * @param Request $request
     * @param Session $session
     * @param EntityManagerInterface $entityManager
     * @return Response
     *
     */
    public function newProduct(Request $request, Session $session, EntityManagerInterface $entityManager): Response {
        $form = $this->createForm(MaterialType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $material = new Material();
            $material->setName($form->get('name')->getData());
            $material->setPriceM3($form->get('priceM3')->getData());
            $material->setType($form->get('type')->getData());
            try {
                $entityManager->persist($material);
                $entityManager->flush();
                $session->getFlashBag()->add('success', sprintf('Dodano % do listy produktów', $material->getName()));
            }catch (UniqueConstraintViolationException $exception) {
                $session->getFlashBag()->add('danger', 'Błąd dodawania produktu');
            }
        }
        return $this->render('admin/new_product.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
