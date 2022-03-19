<?php

namespace App\Tests\Entities;

use App\Entity\App;
use App\Entity\Job;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class AppTest extends TestCase
{
    private static $name = 'test';
    private static $description = 'test';

    public function testIfTrue(): void
    {
        $app = new App();
        $job = new Job();
        $uuid = Uuid::v4();

        $app->setName(self::$name);
        $app->setDescription(self::$description);
        $app->addJob($job);
        $app->setUuid($uuid);

        $this->assertTrue($app->getName() === self::$name);
        $this->assertTrue($app->getDescription() === self::$description);
        $this->assertTrue($app->getJobs()->contains($job));
        $this->assertTrue($app->getUuid() === $uuid);
    }

    public function testIfNull(): void
    {
        $app = new App();

        $this->assertNull($app->getName());
        $this->assertNull($app->getDescription());
        $this->assertNull($app->getId());
        $this->assertNull($app->getUuid());
    }

    public function testAddAndRemoveCron(): void
    {
        $app = new App();
        $job = new Job();

        $app->addJob($job);
        $this->assertTrue($app->getJobs()->contains($job));

        $app->removeJob($job);
        $this->assertFalse($app->getJobs()->contains($job));
    }
}
