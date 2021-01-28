<?php


namespace App\DataFixtures;


use App\Entity\Transport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class TransportFixtures extends Fixture
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * TransportFixtures constructor.
     */
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    /**
     * @param ObjectManager $manager Object manager instance
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void {

        $transports = [
          [
              'name' => 'Odbiór osobisty',
              'price' => 0
          ],
            [
              'name' => 'Transport z rozładunkiem HDS',
              'price' => 800,
          ],
            [
              'name' => 'Transport wywrotką',
              'price' => 400,
          ]
        ];
        foreach ($transports as $transportToCreate) {
            $transport = new Transport();
            $transport->setName($transportToCreate['name']);
            $transport->setPrice($transportToCreate['price']);
            $this->entityManager->persist($transport);
        }
        $this->entityManager->flush();
    }
}