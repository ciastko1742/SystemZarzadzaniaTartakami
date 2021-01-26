<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="app.profile")
     * @return Response
     */
    public function profile(): Response
    {
        return $this->render('profile/index.html.twig', []);
    }

    /**
     * @Route("/admin", name="app.admin")
     * @return Response
     */
    public function admin(): Response
    {
        return new Response('Admin Hello', 200);
    }
}
