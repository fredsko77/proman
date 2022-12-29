<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $firstname = null;

    #[ORM\Column(length: 100)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgProfile = null;

    #[ORM\Column(nullable: true)]
    private ?bool $confirm = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $registered_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $biography = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coverPorfile = null;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: MembreProjet::class)]
    private Collection $projets;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: InvitationProjet::class)]
    private Collection $invitationProjets;

    /**
     * Roles utilisateur
     */
    const ROLE_ADMIN = ['ROLE_ADMINISTRATEUR'];
    const ROLE_USER = ['ROLE_UTILISATEUR'];
    const ROLE_MANAGER = ['ROLE_MANAGER'];

    public function __construct()
    {
        $this->projets = new ArrayCollection();
        $this->invitationProjets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getImgProfile(): ?string
    {
        return $this->imgProfile;
    }

    public function setImgProfile(?string $imgProfile): self
    {
        $this->imgProfile = $imgProfile;

        return $this;
    }

    public function isConfirm(): ?bool
    {
        return $this->confirm;
    }

    public function setConfirm(?bool $confirm): self
    {
        $this->confirm = $confirm;

        return $this;
    }

    public function getRegisteredAt(): ?\DateTimeImmutable
    {
        return $this->registered_at;
    }

    public function setRegisteredAt(\DateTimeImmutable $registered_at): self
    {
        $this->registered_at = $registered_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return array
     */
    public static function roles(): array
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_MANAGER,
            self::ROLE_USER
        ];
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    public function getCoverPorfile(): ?string
    {
        return $this->coverPorfile;
    }

    public function setCoverPorfile(?string $coverPorfile): self
    {
        $this->coverPorfile = $coverPorfile;

        return $this;
    }

    /**
     * @return Collection<int, MembreProjet>
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(MembreProjet $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
            $projet->setUtilisateur($this);
        }

        return $this;
    }

    public function removeProjet(MembreProjet $projet): self
    {
        if ($this->projets->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getUtilisateur() === $this) {
                $projet->setUtilisateur(null);
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
            $invitationProjet->setUtilisateur($this);
        }

        return $this;
    }

    public function removeInvitationProjet(InvitationProjet $invitationProjet): self
    {
        if ($this->invitationProjets->removeElement($invitationProjet)) {
            // set the owning side to null (unless already changed)
            if ($invitationProjet->getUtilisateur() === $this) {
                $invitationProjet->setUtilisateur(null);
            }
        }

        return $this;
    }
}
