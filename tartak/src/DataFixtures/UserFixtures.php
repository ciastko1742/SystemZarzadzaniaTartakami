<?php


namespace App\DataFixtures;


use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder Password encoder instance
     */
    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $entityManager) {
        $this->encoder = $encoder;
        $this->entityManager = $entityManager;
    }
    /**
     * @param ObjectManager $manager Object manager instance
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void {
        $user = new Users();
        $user->setEmail('mateusz@gmail.com');
        $user->setFirstname('Mateusz');
        $user->setLastname('Wrzaszczak');
        $user->setAddress('Kościelna');
        $user->setPhone('123456789');
        $user->setCity('Niegów');
        $user->setPostcode('07-230');
        $user->setCompany('Brak');
        $user->setNip('123123');
        $user->setIdGroup(1);
        $password = $this->encoder->encodePassword($user, 'mateusz');
        $user->setPassword($password);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}