<?php


namespace App\DataFixtures;


use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    /**
     * @param ObjectManager $manager Object manager instance
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void {
        $types = [
            [
                'name' => 'Sosna'
            ],
            [
                'name' => 'Dąb'
            ],
            [
                'name' => 'Brzoza'
            ],
            [
                'name' => 'Świerk'
            ]
        ];
        foreach ($types as $typeToCreate) {
            $type = new Type();
            $type->setName($typeToCreate['name']);
            $this->entityManager->persist($type);
        }
        $this->entityManager->flush();
    }
}