<?php

namespace App\Repository;

use App\Entity\Cart;
use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    public function findByUser(Users $user){
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :user')
            ->andWhere('c.ordered = :ordered')
            ->setParameter('user', $user)
            ->setParameter('ordered', 0)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }


}
