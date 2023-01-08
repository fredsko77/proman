<?php

namespace App\Service;

use DateTimeImmutable;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UtilisateurService
{

    public function __construct(
        private EntityManagerInterface $manager,
        private UserPasswordHasherInterface $hasher,
        private UtilisateurRepository $utilisateurRepository
    ) {
    }

    /**
     * [Description for store]
     *
     * @param Utilisateur $utilisateur
     * 
     * @return Utilisateur if user is persist 
     *         false if user is not persist
     */
    public function store(Utilisateur $utilisateur): mixed
    {
        $now = new DateTimeImmutable;
        $utilisateur->getId() ? $utilisateur->setUpdatedAt($now) : $utilisateur->setRegisteredAt($now);
        $utilisateur->setConfirm(false)
            ->setPassword($this->hasher->hashPassword($utilisateur, $utilisateur->getPassword()));

        $this->manager->persist($utilisateur);
        $this->manager->flush();

        return $utilisateur;


        return false;
    }
}
