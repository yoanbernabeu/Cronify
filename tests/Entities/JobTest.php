<?php

namespace App\Tests\Entities;

use App\Entity\App;
use App\Entity\Cron;
use App\Entity\Job;
use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{
    private static $name = 'test';
    private static $description = 'test';

    public function testIfTrue(): void
    {
        $job = new Job();
        $app = new App();
        $cron = new Cron();

        $job->setName(self::$name);
        $job->setDescription(self::$description);
        $job->setApp($app);
        $job->addCron($cron);

        $this->assertTrue($job->getName() === self::$name);
        $this->assertTrue($job->getDescription() === self::$description);
        $this->assertTrue($job->getApp() === $app);
        $this->assertTrue($job->getCrons()->contains($cron));
    }

    public function testIfNull(): void
    {
        $job = new Job();

        $this->assertNull($job->getName());
        $this->assertNull($job->getDescription());
        $this->assertNull($job->getApp());
        $this->assertNull($job->getId());
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
