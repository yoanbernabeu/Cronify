<?php

namespace App\Service;

use App\Entity\Cron;
use App\Entity\Job;
use Doctrine\Persistence\ManagerRegistry;

class JobService
{
    public function __construct(
        public ManagerRegistry $doctrine
    ) {
    }

    public function startJob(Job $job): Cron
    {
        $cron = new Cron();

        $cron->setJob($job)
            ->setStatus(Cron::$STATUS_RUNNING)
            ->setStartAt(new \DateTimeImmutable('now'));

        $this->doctrine->getManager()->persist($cron);
        $this->doctrine->getManager()->flush();

        return $cron;
    }
}
