<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?float $budget = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $dueDate = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    private ?User $createdBy = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $state = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: ProjectFlow::class, cascade: ['persist', 'remove'])]
    private Collection $projectFlow;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: Document::class, cascade: ['persist', 'remove'])]
    private Collection $documents;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    private ?ProjectType $type = null;


    /**
     * Etats du projet
     */
    const STATE_A_VENIR = 'A venir';
    const STATE_EN_COURS = 'En cours';
    const STATE_EN_REFLEXION = 'En réflexion';
    const STATE_TERMINE = 'Terminé';

    public function __construct()
    {
        $this->projectFlow = new ArrayCollection();
        $this->documents = new ArrayCollection();
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

    public function getBudget(): ?float
    {
        return $this->budget;
    }

    public function setBudget(?float $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    public function getDueDate(): ?\DateTimeImmutable
    {
        return $this->dueDate;
    }

    public function setDueDate(?\DateTimeImmutable $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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
            $projectFlow->setProject($this);
        }

        return $this;
    }

    public function removeProjectFlow(ProjectFlow $projectFlow): self
    {
        if ($this->projectFlow->removeElement($projectFlow)) {
            // set the owning side to null (unless already changed)
            if ($projectFlow->getProject() === $this) {
                $projectFlow->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setProject($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getProject() === $this) {
                $document->setProject(null);
            }
        }

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

    public function getType(): ?ProjectType
    {
        return $this->type;
    }

    public function setType(?ProjectType $type): self
    {
        $this->type = $type;

        return $this;
    }
}
