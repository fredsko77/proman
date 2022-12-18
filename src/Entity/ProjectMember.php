<?php

namespace App\Entity;

use App\Repository\ProjectMemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectMemberRepository::class)]
class ProjectMember
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'projectMembers')]
    private ?Project $project = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $membership_date = null;

    #[ORM\Column]
    private ?bool $isOwner = null;

    #[ORM\ManyToOne(inversedBy: 'projectMembers')]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'member', targetEntity: ProjectFlow::class)]
    private Collection $projectFlow;

    public function __construct()
    {
        $this->projectFlow = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMembershipDate(): ?\DateTimeImmutable
    {
        return $this->membership_date;
    }

    public function setMembershipDate(\DateTimeImmutable $membership_date): self
    {
        $this->membership_date = $membership_date;

        return $this;
    }

    public function isIsOwner(): ?bool
    {
        return $this->isOwner;
    }

    public function setIsOwner(bool $isOwner): self
    {
        $this->isOwner = $isOwner;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, ProjectFlow>
     */
    public function getProjectFlow(): Collection
    {
        return $this->projectFlow;
    }

    public function addProjectFlow(ProjectFlow $projectFlow): self
    {
        if (!$this->projectFlow->contains($projectFlow)) {
            $this->projectFlow->add($projectFlow);
            $projectFlow->setMember($this);
        }

        return $this;
    }

    public function removeProjectFlow(ProjectFlow $projectFlow): self
    {
        if ($this->projectFlow->removeElement($projectFlow)) {
            // set the owning side to null (unless already changed)
            if ($projectFlow->getMember() === $this) {
                $projectFlow->setMember(null);
            }
        }

        return $this;
    }
}
