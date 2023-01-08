<?php

namespace App\Controller\Auth;

use App\Entity\Utilisateur;
use App\Form\Auth\InscriptionType;
use App\Mailing\AuthMailing;
use App\Service\UtilisateurService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[Route('/auth/inscription', name: 'auth_inscription')]
class InscriptionController extends AbstractController
{

    public function __construct(
        private UtilisateurService $service,
        private AuthMailing $mailing
    ) {
    }

    #[Route('', name: '', methods: ['POST', 'GET'])]
    public function inscription(Request $request): Response
    {
        if ($this->getUser()) {

            return $this->redirectToRoute('admin');
        }

        $utilisateur = new Utilisateur;
        $form = $this->createForm(InscriptionType::class, $utilisateur);
        $form->handleRequest($request);
        $user = [
            'username' => 'fagathe',
            'email' => 'fagathe77@gmail.com',
        ];

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur->setRoles(['ROLE_UTILISATEUR']);
            $this->service->store($utilisateur);
            $this->mailing->confirmEmail($utilisateur);

            $this->addFlash(
                'success',
                'Votre compte a bien été crée'
            );

            return $this->redirectToRoute('auth_inscription');
        }

        return $this->renderForm('auth/inscription.html.twig', compact('form', 'utilisateur', 'user'));
    }

    #[Route('/{token}', name: '_confirm', methods: ['GET'])]
    public function inscriptionConfirm(): Response
    {

        return $this->render('', compact(''));
    }
}
