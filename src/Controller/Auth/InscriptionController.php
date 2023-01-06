<?php

namespace App\Controller\Auth;

use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route('/auth', name: 'auth_')]
class InscriptionController extends AbstractController
{

    #[Route('/inscription', name: 'inscription', methods: ['POST', 'GET'])]
    public function inscription(Request $request): Response
    {
        if ($this->getUser()) {

            return $this->redirectToRoute('admin');
        }

        $user = new Utilisateur;
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->service->store($user);

            $this->addFlash(
                'success',
                'Votre compte a bien été crée'
            );

            return $this->redirectToRoute('auth_signup');
        }

        return $this->renderForm(
            'auth/inscription.html.twig',
            //compact('form')
        );
    }
}
