<?php

namespace App\Entity;

use App\Repository\ProjectFlowRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectFlowRepository::class)]
class ProjectFlow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\ManyToOne(inversedBy: 'projectFlow')]
    private ?Project $project = null;

    #[ORM\ManyToOne(inversedBy: 'projectFlow')]
    private ?ProjectMember $member = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getMember(): ?ProjectMember
    {
        return $this->member;
    }

    public function setMember(?ProjectMember $member): self
    {
        $this->member = $member;

        return $this;
    }
}
