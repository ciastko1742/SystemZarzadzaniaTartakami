<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils) : Response {
        $errors = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login/index.html.twig', [
            'errors' => $errors,
            'username' => $lastUsername
        ]);
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logout() : Response {}

    /**
     * @Route("/register", name="registration")
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        EntityManagerInterface $entityManager,
        Session $session
    ) : Response {
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = new Users();
            $user->setEmail($form->get('email')->getData());
            $user->setNip($form->get('nip')->getData());
            $user->setCompany($form->get('company')->getData());
            $user->setPostcode($form->get('postcode')->getData());
            $user->setCity($form->get('city')->getData());
            $user->setPhone($form->get('phone')->getData());
            $user->setAddress($form->get('address')->getData());
            $user->setLastname($form->get('lastname')->getData());
            $user->setFirstname($form->get('firstname')->getData());
            $user->getRoles();
            $password = $passwordEncoder->encodePassword($user, $form->get('password')->getData());
            $user->setPassword($password);
            try {
                $entityManager->persist($user);
                $entityManager->flush();
                $session->getFlashBag()->add('success', sprintf('Konto użytkownika % zostało pomyślnie stworzone', $user->getFirstname()));
            }catch (UniqueConstraintViolationException $exception) {
                $session->getFlashBag()->add('danger', 'Podany e-mail już istenieje w bazie systemu');
            }
        }
        return $this->render('login/register.html.twig',[
           'form'=>$form->createView()
        ]);
    }

}
