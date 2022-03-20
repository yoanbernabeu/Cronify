<?php

namespace App\Tests\Repository;

use App\Entity\Job;
use App\Repository\AppRepository;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Uid\Uuid;

class JobRepositoryTest extends KernelTestCase
{
    public function testShouldBeCreateNewApp(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $jobRepository = static::getContainer()->get(JobRepository::class);
        $appRepository = static::getContainer()->get(AppRepository::class);

        $this->assertInstanceOf(JobRepository::class, $jobRepository);

        $app = $appRepository->findOneBy(['id' => 1]);
        $job = new Job();

        $job->setApp($app)
            ->setName('test')
            ->setDescription('test')
            ->setUuid(Uuid::v4());

        $jobRepository->add($job);
    }

    public function testShouldBeCreateNewAppAndRemove(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $jobRepository = static::getContainer()->get(JobRepository::class);
        $appRepository = static::getContainer()->get(AppRepository::class);

        $this->assertInstanceOf(JobRepository::class, $jobRepository);

        $app = $appRepository->findOneBy(['id' => 1]);
        $job = new Job();

        $job->setApp($app)
            ->setName('test')
            ->setDescription('test')
            ->setUuid(Uuid::v4());

        $jobRepository->add($job);

        $jobRepository->remove($job);
    }
}
