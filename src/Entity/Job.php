<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobRepository::class)]
class Job
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\OneToMany(mappedBy: 'job', targetEntity: Cron::class)]
    private $crons;

    #[ORM\ManyToOne(targetEntity: App::class, inversedBy: 'jobs')]
    private $app;

    #[ORM\Column(type: 'uuid')]
    private $uuid;

    public function __construct()
    {
        $this->crons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Cron>
     */
    public function getCrons(): Collection
    {
        return $this->crons;
    }

    public function addCron(Cron $cron): self
    {
        if (!$this->crons->contains($cron)) {
            $this->crons[] = $cron;
            $cron->setJob($this);
        }

        return $this;
    }

    public function removeCron(Cron $cron): self
    {
        if ($this->crons->removeElement($cron)) {
            // set the owning side to null (unless already changed)
            if ($cron->getJob() === $this) {
                $cron->setJob(null);
            }
        }

        return $this;
    }

    public function getApp(): ?App
    {
        return $this->app;
    }

    public function setApp(?App $app): self
    {
        $this->app = $app;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name.' ('.$this->app->getName().')';
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setUuid($uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }
}
