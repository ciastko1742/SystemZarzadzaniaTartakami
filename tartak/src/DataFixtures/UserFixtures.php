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
        //Dodanie 3 testowych użytkowników

        $users = [
          [
              'mail' => 'mateusz@gmail.com',
              'firstname' => 'Mateusz',
              'lastname' => 'Wrzaszczak',
              'address' => 'Kościelna',
              'phone' => '123321123',
              'city'=>'Niegów',
              'postcode'=>'01-111',
              'company'=>'Firma',
              'nip'=>'123123123',
              'group'=>1,
              'roles'=>['ROLE_USER']
          ],
            [
              'mail' => 'admin@gmail.com',
              'firstname' => 'Admin',
              'lastname' => 'Admin',
              'address' => 'Kościelna',
              'phone' => '123321123',
              'city'=>'Niegów',
              'postcode'=>'01-111',
              'company'=>'Firma',
              'nip'=>'123123123',
              'group'=>1,
              'roles'=>['ROLE_ADMIN']
          ],
            [
              'mail' => 'superadmin@gmail.com',
              'firstname' => 'SuperAdmin',
              'lastname' => 'Admin',
              'address' => 'Kościelna',
              'phone' => '123321123',
              'city'=>'Niegów',
              'postcode'=>'01-111',
              'company'=>'Firma',
              'nip'=>'123123123',
              'group'=>1,
              'roles'=>['ROLE_SUPERADMIN']
          ]
        ];
        foreach ($users as $userToCreate) {
            $user = new Users();
            $user->setEmail($userToCreate['mail']);
            $user->setFirstname($userToCreate['firstname']);
            $user->setLastname($userToCreate['lastname']);
            $user->setAddress($userToCreate['address']);
            $user->setPhone($userToCreate['phone']);
            $user->setCity($userToCreate['city']);
            $user->setPostcode($userToCreate['postcode']);
            $user->setCompany($userToCreate['company']);
            $user->setNip($userToCreate['nip']);
            $user->setIdGroup(1);
            $user->setRoles($userToCreate['roles']);
            $password = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($password);
            $this->entityManager->persist($user);
        }
        $this->entityManager->flush();
    }
}