<?php

namespace App\Repository;

use App\Entity\Cron;
use App\Entity\Job;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cron|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cron|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cron[]    findAll()
 * @method Cron[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CronRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cron::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Cron $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Cron $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findTheLastOneByJob(Job $job): ?Cron
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC')
            ->where('c.job = :job')
            ->setParameter('job', $job)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
