<?php

namespace App\Entity;

use App\Repository\CronRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CronRepository::class)]
class Cron
{
    public static $STATUS_PENDING = 'pending';
    public static $STATUS_RUNNING = 'running';
    public static $STATUS_SUCCESS = 'success';
    public static $STATUS_FAILURE = 'failure';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime_immutable')]
    private $startAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $endAt;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $status;

    #[ORM\ManyToOne(targetEntity: Job::class, inversedBy: 'crons')]
    private $job;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeImmutable $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeImmutable $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): self
    {
        $this->job = $job;

        return $this;
    }
}
