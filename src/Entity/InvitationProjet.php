<?php

namespace App\Entity;

use App\Repository\InvitationProjetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvitationProjetRepository::class)]
class InvitationProjet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'invitationProjets')]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'invitationProjets')]
    private ?Projet $projet = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $expiredAt = null;

    #[ORM\Column]
    private ?bool $isAccepted = null;

    #[ORM\ManyToOne]
    private ?Utilisateur $sender = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

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

    public function getExpiredAt(): ?\DateTimeImmutable
    {
        return $this->expiredAt;
    }

    public function setExpiredAt(\DateTimeImmutable $expiredAt): self
    {
        $this->expiredAt = $expiredAt;

        return $this;
    }

    public function isIsAccepted(): ?bool
    {
        return $this->isAccepted;
    }

    public function setIsAccepted(bool $isAccepted): self
    {
        $this->isAccepted = $isAccepted;

        return $this;
    }

    public function getSender(): ?Utilisateur
    {
        return $this->sender;
    }

    public function setSender(?Utilisateur $sender): self
    {
        $this->sender = $sender;

        return $this;
    }
}
