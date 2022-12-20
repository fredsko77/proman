<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $orignalName = null;

    #[ORM\Column(length: 255)]
    private ?string $path = null;

    #[ORM\Column(length: 255)]
    private ?string $size = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    private ?Project $project = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    private ?FileType $fileType = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    private ?ProjectMember $member = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrignalName(): ?string
    {
        return $this->orignalName;
    }

    public function setOrignalName(string $orignalName): self
    {
        $this->orignalName = $orignalName;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

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

    public function getFileType(): ?FileType
    {
        return $this->fileType;
    }

    public function setFileType(?FileType $fileType): self
    {
        $this->fileType = $fileType;

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
