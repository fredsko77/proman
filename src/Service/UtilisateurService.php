<?php

use App\Entity\Utilisateur;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UtilisateurService
{

    public function __construct(
        private EntityManagerInterface $manager,
        private UserPasswordHasherInterface $hasher,
        private UserRepository $userRepository
    ) {
    }
}
