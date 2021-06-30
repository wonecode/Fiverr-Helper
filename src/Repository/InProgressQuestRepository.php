<?php

namespace App\Repository;

use App\Entity\InProgressQuest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InProgressQuest|null find($id, $lockMode = null, $lockVersion = null)
 * @method InProgressQuest|null findOneBy(array $criteria, array $orderBy = null)
 * @method InProgressQuest[]    findAll()
 * @method InProgressQuest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InProgressQuestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InProgressQuest::class);
    }

    // /**
    //  * @return InProgressQuest[] Returns an array of InProgressQuest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InProgressQuest
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
