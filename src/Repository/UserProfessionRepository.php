<?php

namespace App\Repository;

use App\Entity\UserProfession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserProfession|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserProfession|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserProfession[]    findAll()
 * @method UserProfession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserProfessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserProfession::class);
    }

    // /**
    //  * @return UserProfession[] Returns an array of UserProfession objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserProfession
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
