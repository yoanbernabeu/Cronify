<?php

namespace App\Service;

use App\Entity\Cron;
use App\Entity\Job;
use App\Repository\CronRepository;
use Doctrine\Persistence\ManagerRegistry;

class JobService
{
    public function __construct(
        public ManagerRegistry $doctrine,
        public CronRepository $cronRepository
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

    public function stopJobinSuccess(Job $job): Cron
    {
        $lastCron = $this->cronRepository->findTheLastOneByJob($job);
        $lastCron->setStatus(Cron::$STATUS_SUCCESS)
                 ->setEndAt(new \DateTimeImmutable('now'));

        $this->doctrine->getManager()->persist($lastCron);
        $this->doctrine->getManager()->flush();

        return $lastCron;
    }

    public function stopJobinFailure(Job $job): Cron
    {
        $lastCron = $this->cronRepository->findTheLastOneByJob($job);
        $lastCron->setStatus(Cron::$STATUS_FAILURE)
                 ->setEndAt(new \DateTimeImmutable('now'));

        $this->doctrine->getManager()->persist($lastCron);
        $this->doctrine->getManager()->flush();

        return $lastCron;
    }

    public function CronResponse(Cron $cron): array
    {
        return [
            'id' => $cron->getId(),
            'job' => $cron->getJob()->getName(),
            'app' => $cron->getJob()->getApp()->getName(),
            'status' => $cron->getStatus(),
            'start_at' => $cron->getStartAt()->format('Y-m-d H:i:s'),
            'end_at' => $cron->getEndAt() ? $cron->getEndAt()->format('Y-m-d H:i:s') : null,
        ];
    }
}
