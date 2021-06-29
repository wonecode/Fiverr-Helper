<?php

namespace App\Repository;

use App\Entity\Easter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Easter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Easter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Easter[]    findAll()
 * @method Easter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EasterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Easter::class);
    }

    // /**
    //  * @return Easter[] Returns an array of Easter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Easter
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
