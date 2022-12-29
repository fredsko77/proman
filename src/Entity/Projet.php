<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $state = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $budget = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: Note::class)]
    private Collection $notes;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: MembreProjet::class)]
    private Collection $membres;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: InvitationProjet::class)]
    private Collection $invitationProjets;

    #[ORM\OneToMany(mappedBy: 'projet', targetEntity: Task::class)]
    private Collection $tasks;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->membres = new ArrayCollection();
        $this->invitationProjets = new ArrayCollection();
        $this->tasks = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

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

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(?int $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Note>
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes->add($note);
            $note->setProjet($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getProjet() === $this) {
                $note->setProjet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MembreProjet>
     */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembre(MembreProjet $membre): self
    {
        if (!$this->membres->contains($membre)) {
            $this->membres->add($membre);
            $membre->setProjet($this);
        }

        return $this;
    }

    public function removeMembre(MembreProjet $membre): self
    {
        if ($this->membres->removeElement($membre)) {
            // set the owning side to null (unless already changed)
            if ($membre->getProjet() === $this) {
                $membre->setProjet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, InvitationProjet>
     */
    public function getInvitationProjets(): Collection
    {
        return $this->invitationProjets;
    }

    public function addInvitationProjet(InvitationProjet $invitationProjet): self
    {
        if (!$this->invitationProjets->contains($invitationProjet)) {
            $this->invitationProjets->add($invitationProjet);
            $invitationProjet->setProjet($this);
        }

        return $this;
    }

    public function removeInvitationProjet(InvitationProjet $invitationProjet): self
    {
        if ($this->invitationProjets->removeElement($invitationProjet)) {
            // set the owning side to null (unless already changed)
            if ($invitationProjet->getProjet() === $this) {
                $invitationProjet->setProjet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
            $task->setProjet($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getProjet() === $this) {
                $task->setProjet(null);
            }
        }

        return $this;
    }
}
