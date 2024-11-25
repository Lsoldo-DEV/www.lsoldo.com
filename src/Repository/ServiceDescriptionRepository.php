<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Description;
use App\Entity\Project;
use App\Entity\Realization;
use App\Entity\Service;
use App\Entity\ServiceDescription;
use App\Utils\Constant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ServiceDescription>
 */
class ServiceDescriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceDescription::class);
    }

    public function getDescription(Service $entity, string $local):?ServiceDescription{

        $query=  $this->createQueryBuilder('s')
            ->andWhere('s.service = :service')
            ->setParameter('service', $entity);


        $description = $query
            ->andWhere('s.lang = :lang')
            ->setParameter('lang', $local)->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();

        if($description instanceof ServiceDescription) return $description;
        else{
            return $query
                ->andWhere('s.lang = :lang')
                ->setParameter('lang', Constant::DEFAULT_DESCRIPTION_LANGUAGE)->getQuery()
                ->setMaxResults(1)
                ->getOneOrNullResult();
        }
        #return $description;


    }
//    /**
//     * @return ServiceDescription[] Returns an array of ServiceDescription objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ServiceDescription
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
