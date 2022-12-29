<?php

namespace App\Entity;

use App\Repository\FileTypeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FileTypeRepository::class)]
class FileType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $icon = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $extensions = [];

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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getExtensions(): array
    {
        return $this->extensions;
    }

    public function setExtensions(array $extensions): self
    {
        $this->extensions = $extensions;

        return $this;
    }
}
