<?php

namespace App\Tests\Repository;

use App\Entity\Cron;
use App\Repository\CronRepository;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CronRepositoryTest extends KernelTestCase
{
    public function testShouldBeCreateNewCron(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $cronRepository = static::getContainer()->get(CronRepository::class);

        $jobRepository = static::getContainer()->get(JobRepository::class);
        $job = $jobRepository->findOneBy(['id' => 1]);

        $this->assertInstanceOf(CronRepository::class, $cronRepository);

        $cron = new Cron();
        $cron->setJob($job)
             ->setStartAt(new \DateTimeImmutable('now'));

        $cronRepository->add($cron);
    }

    public function testShouldBeCreateNewCronAndDelete(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $cronRepository = static::getContainer()->get(CronRepository::class);

        $jobRepository = static::getContainer()->get(JobRepository::class);
        $job = $jobRepository->findOneBy(['id' => 1]);

        $this->assertInstanceOf(CronRepository::class, $cronRepository);

        $cron = new Cron();
        $cron->setJob($job)
             ->setStartAt(new \DateTimeImmutable('now'));

        $cronRepository->add($cron);

        $cronRepository->remove($cron);
    }
}
