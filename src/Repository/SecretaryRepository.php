<?php

namespace App\Repository;

use App\Entity\Secretary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Secretary|null find($id, $lockMode = null, $lockVersion = null)
 * @method Secretary|null findOneBy(array $criteria, array $orderBy = null)
 * @method Secretary[]    findAll()
 * @method Secretary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SecretaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Secretary::class);
    }

    // /**
    //  * @return Secretary[] Returns an array of Secretary objects
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
    public function findOneBySomeField($value): ?Secretary
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
