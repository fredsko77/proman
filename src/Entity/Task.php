<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne]
    private ?Utilisateur $reporter = null;

    #[ORM\ManyToOne]
    private ?Utilisateur $assignee = null;

    #[ORM\Column]
    private ?bool $isDone = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    private ?Projet $projet = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\ManyToMany(targetEntity: TagProjet::class, inversedBy: 'tasks')]
    private Collection $tag;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
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

    public function getReporter(): ?Utilisateur
    {
        return $this->reporter;
    }

    public function setReporter(?Utilisateur $reporter): self
    {
        $this->reporter = $reporter;

        return $this;
    }

    public function getAssignee(): ?Utilisateur
    {
        return $this->assignee;
    }

    public function setAssignee(?Utilisateur $assignee): self
    {
        $this->assignee = $assignee;

        return $this;
    }

    public function isIsDone(): ?bool
    {
        return $this->isDone;
    }

    public function setIsDone(bool $isDone): self
    {
        $this->isDone = $isDone;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection<int, TagProjet>
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(TagProjet $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag->add($tag);
        }

        return $this;
    }

    public function removeTag(TagProjet $tag): self
    {
        $this->tag->removeElement($tag);

        return $this;
    }
}
