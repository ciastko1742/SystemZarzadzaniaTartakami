<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserType;
use App\Repository\UsersRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("user/edit/{id}", name="user_edit")
     * Method({"GET", "POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function edit(Request $request, UserPasswordEncoderInterface $passwordEncoder, $id){
        $user = new Users();
        $user = $this->getDoctrine()->getRepository(Users::class)->find($id);
        $form = $this->createFormBuilder($user)
        ->add('firstname', TextType::class, [
                'label' => 'Imiê'
            ])
            ->add('lastname', TextType::class)
            ->add('company', TextType::class)
            ->add('nip',  NumberType::class)
            ->add('address', TextType::class)
            ->add('city', TextType::class)
            ->add('postcode',TextType::class)
            ->add('phone', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Has³o'],
                'second_options' => ['label' => 'Powtórz has³o']
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Zapisz',
                'attr' => array('class' => 'btn btn-primary mt-3')
			])
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $password = $passwordEncoder->encodePassword($user, $form->get('password')->getData());
                $user->setPassword($password);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();

                return $this->redirectToRoute('user');
			}
            return $this->render('user/edit.html.twig', array(
                'form' => $form->createView()
            ));
	}
}
