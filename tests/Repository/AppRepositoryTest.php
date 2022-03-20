<?php

namespace App\Tests\Repository;

use App\Entity\App;
use App\Repository\AppRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Uid\Uuid;

class AppRepositoryTest extends KernelTestCase
{
    public function testShouldBeCreateNewApp(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $appRepository = static::getContainer()->get(AppRepository::class);

        $this->assertInstanceOf(AppRepository::class, $appRepository);

        $app = new App();
        $app->setName('test')
            ->setDescription('test')
            ->setUuid(Uuid::v4());

        $appRepository->add($app);
    }

    public function testShouldBeCreateNewAppAndRemove(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        $appRepository = static::getContainer()->get(AppRepository::class);

        $this->assertInstanceOf(AppRepository::class, $appRepository);

        $app = new App();
        $app->setName('test')
            ->setDescription('test')
            ->setUuid(Uuid::v4());

        $appRepository->add($app);

        $appRepository->remove($app);
    }
}
