<?php

namespace App\Repository;

use App\Entity\IdentifiedCase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
            ->where('IdentifiedCase.firstDate < :date')
            ->setParameter(':date', $date)
            ->getQuery()
            ->execute();
    }

    public function getNewIdentifiedCase(int $day, float $temperature)
    {
        $date = new \DateTime();
        $date->modify("-" . $day . " day");

        return $this->createQueryBuilder('IdentifiedCase')
            ->where('IdentifiedCase.firstDate > :date')
            ->setParameter(':date', $date)
            ->andWhere('IdentifiedCase.temperature > :temperature')
            ->setParameter(':temperature', $temperature)
            ->getQuery()
            ->getResult();
    }

    public function getReturnAttempts(int $day, float $temperature, string $uuid): array
    {
        $date = new \DateTime();
        $date->modify("-" . $day . " day");

        return $this->createQueryBuilder('IdentifiedCase')
            ->where('IdentifiedCase.firstDate > :date')
            ->setParameter(':date', $date)
            ->andWhere('IdentifiedCase.temperature > :temperature')
            ->setParameter(':temperature', $temperature)
            ->andWhere('IdentifiedCase.uuid = :uuid')
            ->setParameter(':uuid', $uuid)
            ->getQuery()
            ->getResult();
    }

    public function getListOfReturnAttempts(string $uuid, $date): array
    {
        return $this->createQueryBuilder('IdentifiedCase')
            ->where('IdentifiedCase.firstDate > :date')
            ->setParameter(':date', $date)
            ->andWhere('IdentifiedCase.uuid = :uuid')
            ->setParameter(':uuid', $uuid)
            ->getQuery()
            ->getResult();
    }

    public function isEntranceAllowed(string $uuid): bool
    {
        $date = new \DateTime();
        $date->modify('-1 day');

        $result = $this->createQueryBuilder('IdentifiedCase')
            ->where('IdentifiedCase.allowEntrance > :date')
            ->setParameter(':date', $date)
            ->andWhere('IdentifiedCase.uuid = :uuid')
            ->setParameter(':uuid', $uuid)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $result === null;
    }

    public function getNumberOfEntriesPerDay(int $day): int
    {
        $date = new \DateTime("midnight");
        $date->modify("-" . $day . " day");
        $date1 = new \DateTime("midnight");
        $date1->modify("-" . $day . " day");
        $date1->modify('+1 day');

        return $this->createQueryBuilder('IdentifiedCase')
            ->select('COUNT(DISTINCT IdentifiedCase.uuid)')
            ->where('IdentifiedCase.firstDate > :date')
            ->setParameter(':date', $date)
            ->andWhere('IdentifiedCase.firstDate < :date1')
            ->setParameter(':date1', $date1)
            ->distinct()
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getNumberOfValidEntriesPerDay(int $day, float $temperature): int
    {
        $date = new \DateTime("midnight");
        $date->modify("-" . $day . " day");
        $date1 = new \DateTime("midnight");
        $date1->modify("-" . $day . " day");
        $date1->modify('+1 day');

        return $this->createQueryBuilder('IdentifiedCase')
            ->select('COUNT(DISTINCT IdentifiedCase.uuid)')
            ->where('IdentifiedCase.firstDate > :date')
            ->setParameter(':date', $date)
            ->andWhere('IdentifiedCase.firstDate < :date1')
            ->setParameter(':date1', $date1)
            ->andWhere('IdentifiedCase.temperature > :temperature')
            ->setParameter(':temperature', $temperature)
            ->distinct()
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getOldIdentifiedCase(int $days, float $temperature, int $day): array
    {
        $date = new \DateTime("midnight");
        $date->modify("-" . $day . " day");
        $date->modify('+1 day');
        $lastDate = 1 + $day + $days;
        $date1 = new \DateTime("midnight");
        $date1->modify("-" . $lastDate . " day");

        return $this->createQueryBuilder('IdentifiedCase')
            ->where('IdentifiedCase.firstDate > :date1')
            ->setParameter(':date1', $date1)
            ->andWhere('IdentifiedCase.firstDate < :date')
            ->setParameter(':date', $date)
            ->andWhere('IdentifiedCase.temperature > :temperature')
            ->setParameter(':temperature', $temperature)
            ->getQuery()
            ->getResult();
    }

    public function getNumberOfReturnsOfBannedPeople(string $uuid, int $day): int
    {
        $date1 = new \DateTime("midnight");
        $date1->modify("-" . $day . " day");
        $date2 = new \DateTime("midnight");
        $date2->modify("-" . $day . " day");
        $date2->modify('+1 day');

        return $this->createQueryBuilder('IdentifiedCase')
            ->select('COUNT(DISTINCT IdentifiedCase.uuid)')
            ->where('IdentifiedCase.uuid = :uuid')
            ->setParameter(':uuid', $uuid)
            ->andWhere('IdentifiedCase.firstDate > :date1')
            ->setParameter(':date1', $date1)
            ->andWhere('IdentifiedCase.firstDate < :date2')
            ->setParameter(':date2', $date2)
            ->distinct()
            ->getQuery()
            ->getSingleScalarResult();
    }
}
