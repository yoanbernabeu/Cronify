<?php

namespace App\Tests\Entities;

use App\Entity\App;
use App\Entity\Cron;
use App\Entity\Job;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class JobTest extends TestCase
{
    private static $name = 'test';
    private static $description = 'test';

    public function testIfTrue(): void
    {
        $job = new Job();
        $app = new App();
        $cron = new Cron();
        $uuid = Uuid::v4();

        $job->setName(self::$name);
        $job->setDescription(self::$description);
        $job->setApp($app);
        $job->addCron($cron);
        $job->setUuid($uuid);

        $this->assertTrue($job->getName() === self::$name);
        $this->assertTrue($job->getDescription() === self::$description);
        $this->assertTrue($job->getApp() === $app);
        $this->assertTrue($job->getCrons()->contains($cron));
        $this->assertTrue($job->getUuid() === $uuid);
    }

    public function testIfNull(): void
    {
        $job = new Job();

        $this->assertNull($job->getName());
        $this->assertNull($job->getDescription());
        $this->assertNull($job->getApp());
        $this->assertNull($job->getId());
        $this->assertNull($job->getUuid());
    }

    public function testAddAndRemoveCron(): void
    {
        $job = new Job();
        $cron = new Cron();

        $job->addCron($cron);
        $this->assertTrue($job->getCrons()->contains($cron));

        $job->removeCron($cron);
        $this->assertFalse($job->getCrons()->contains($cron));
    }
}
