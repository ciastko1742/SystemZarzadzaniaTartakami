<?php

namespace App\Controller;

use App\Entity\Calculation;
use App\Entity\Cart;
use App\Entity\Offer;
use App\Entity\Order;
use App\Entity\Transport;
use App\Repository\CartRepository;
use App\Repository\MaterialRepository;
use App\Repository\OfferRepository;
use App\Repository\TransportRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(CartRepository $cartRepository, OfferRepository $offerRepository, TransportRepository $transportRepository): Response
    {
        $cart = $cartRepository->findByUser($this->getUser());
        $sumPriceForProduct = $cart ? $offerRepository->sum($cart) : 0;
        $transportPrice = ($cart && $cart->getTransport()) ? $cart->getTransport()->getPrice() : 0;
        $sumPriceForAll = $transportPrice + $sumPriceForProduct;

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
            'sumPriceForProduct'=> $sumPriceForProduct,
            'transports'=>$transportRepository->findAll(),
            'sumPriceForAll' => $sumPriceForAll
        ]);
    }

    /**
     * @Route("/cart/add", name="add_to_cart")
     * @param Request $request
     */
    public function addCart(Request $request, MaterialRepository $materialRepository, EntityManagerInterface $entityManager, CartRepository $cartRepository, Session $session)
    {
        $calculation = new Calculation();
        $calculation->setHeight($request->request->get('height'));
        $calculation->setWidth($request->request->get('width'));
        $calculation->setLength($request->request->get('length'));
        $calculation->setQuantity($request->request->get('quantity'));
        $material = $materialRepository->findOneBy(['id'=> $request->request->get('material')]);
        if($material){
            $calculation->setMaterial($material);
        }
        if($price = $calculation->countPrice()){
            $calculation->setPrice($price);
        }

        $cart = $cartRepository->findByUser($this->getUser());
        if(!$cart){
            $cart = new Cart();
            $cart->setDateAdd(new \DateTime());
            $cart->setUser($this->getUser());
        }

        $offer = new Offer();
        $offer->setCalculation($calculation);
        $offer->setUser($this->getUser());
        $offer->setCart($cart);

        try {
            $entityManager->persist($calculation);
            $entityManager->persist($cart);
            $entityManager->persist($offer);
            $entityManager->flush();
            $session->getFlashBag()->add('success', sprintf('Dodano % do koszyka!', $material->getName()));
        }catch (UniqueConstraintViolationException $exception) {
            $session->getFlashBag()->add('danger', 'Błąd dodawania do koszyka!');
        }

        return $this->redirectToRoute("welcome");
    }

    /**
     * @Route("/cart/delete", name="delete_offer")
     * @param Request $request
     */
    public function delete(Request $request, Session $session){
        if($offer = $this->getDoctrine()->getRepository(Offer::class)->find($request->request->get('offer'))){
            $entityManager = $this->getDoctrine()->getManager();

            try {
                $entityManager->remove($offer);
                $entityManager->flush();
                $session->getFlashBag()->add('success', sprintf('Usunięto z koszyka!'));
            }catch (UniqueConstraintViolationException $exception) {
                $session->getFlashBag()->add('danger', 'Błąd usuwania z koszyka!');
            }
        }
        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/cart/count_price", name="countPrice")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function countPrice(Request $request){

        $transport = $this->getDoctrine()->getRepository(Transport::class)->find($request->request->get("transport_id"));

        $cart = $this->getDoctrine()->getRepository(Cart::class)->findByUser($this->getUser());
        $sumPriceForProduct = $this->getDoctrine()->getRepository(Offer::class)->sum($cart);
        $sumPriceForAll = $transport->getPrice() + $sumPriceForProduct;

        return $this->json(['sum'=>$sumPriceForAll]);

    }

    /**
     * @Route("/cart/create_order_or_save", name="createOrderOrSave")
     * @param Request $request
     */
    public function createOrderOrSave(Request $request){
        $createOrder = $request->request->get("create_order");

        $transport = $this->getDoctrine()->getRepository(Transport::class)->find($request->request->get("transport"));

        $cart = $this->getDoctrine()->getRepository(Cart::class)->findByUser($this->getUser());
        $sumPriceForProduct = $this->getDoctrine()->getRepository(Offer::class)->sum($cart);
        $sumPriceForAll = $transport->getPrice() + $sumPriceForProduct;

        $cart->setFinalPrice($sumPriceForAll);
        $cart->setTransport($transport);

        $entityManager = $this->getDoctrine()->getManager();


        $message = "Zapisano w koszyku.";
        if(isset($createOrder)){
            $cart->setOrdered(1);
            $order = new Order();
            $order->setDateAdd(new \DateTime());
            $order->setCart($cart);

            $entityManager->persist($order);
            $message = "Złożono zamówienie";
        }
        $entityManager->persist($cart);
        try {
            $entityManager->flush();
            $this->addFlash("success",$message);
        }catch (UniqueConstraintViolationException $exception) {
            $this->addFlash('danger', 'Błąd!');
        }
        return $this->redirectToRoute("cart");
    }
}
