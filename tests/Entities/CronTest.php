<?php

namespace App\Tests\Entities;

use App\Entity\Cron;
use App\Entity\Job;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class CronTest extends TestCase
{
    private static $startAt = '2022-01-01 00:00:00';
    private static $endAt = '2022-01-01 00:01:00';
    private static $statusActive = 'active';
    private static $statusFinished = 'finished';

    public function testIfTrueWithStatusIsActive(): void
    {
        $cron = new Cron();
        $job = new Job();

        $cron->setStartAt(new DateTimeImmutable(self::$startAt));
        $cron->setStatus(self::$statusActive);
        $cron->setJob($job);

        $this->assertTrue($cron->getStartAt()->format('Y-m-d H:i:s') === self::$startAt);
        $this->assertTrue($cron->getStatus() === self::$statusActive);
        $this->assertTrue($cron->getJob() === $job);
    }

    public function testIfTrueWithStatusIsFinished(): void
    {
        $cron = new Cron();
        $job = new Job();

        $cron->setStartAt(new DateTimeImmutable(self::$startAt));
        $cron->setEndAt(new DateTimeImmutable(self::$endAt));
        $cron->setStatus(self::$statusFinished);
        $cron->setJob($job);

        $this->assertTrue($cron->getStartAt()->format('Y-m-d H:i:s') === self::$startAt);
        $this->assertTrue($cron->getEndAt()->format('Y-m-d H:i:s') === self::$endAt);
        $this->assertTrue($cron->getStatus() === self::$statusFinished);
        $this->assertTrue($cron->getJob() === $job);
    }

    public function testIfNull(): void
    {
        $cron = new Cron();

        $this->assertNull($cron->getStartAt());
        $this->assertNull($cron->getEndAt());
        $this->assertNull($cron->getStatus());
        $this->assertNull($cron->getId());
    }
}
