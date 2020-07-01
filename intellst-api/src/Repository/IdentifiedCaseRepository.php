<?php

namespace App\Repository;

use App\Entity\IdentifiedCase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IdentifiedCase|null find($id, $lockMode = null, $lockVersion = null)
 * @method IdentifiedCase|null findOneBy(array $criteria, array $orderBy = null)
 * @method IdentifiedCase[]    findAll()
 * @method IdentifiedCase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdentifiedCaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IdentifiedCase::class);
    }

    public function removeCases()
    {
        $date = new \DateTime();
        $date->modify('-90 day');

        return $this->createQueryBuilder('IdentifiedCase')
            ->delete()
            ->Where('IdentifiedCase.firstDate < :date')
            ->setParameter(':date', $date)
            ->getQuery()
            ->execute();
    }

    // /**
    //  * @return IdentifiedCase[] Returns an array of IdentifiedCase objects
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
    public function findOneBySomeField($value): ?IdentifiedCase
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
