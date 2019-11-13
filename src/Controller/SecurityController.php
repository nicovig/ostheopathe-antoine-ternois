<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    public function __construct(TokenStorageInterface $tokenStorage){
        $this->user = $tokenStorage->getToken()->getUser();
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils){
        $lastUsername = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/vous-n-avez-pas-les-droits-requis", name="redirect.rights")
     * @return Response
     */
    public function redirectRights():Response{
        return $this->render('security/redirect.html.twig', [
            'user' => $this->user
        ]);
    }

    /**
     * @Route("/mauvais-chemin", name="redirect.not.found")
     * @return Response
     */
    public function wrongPath():Response{
        return $this->render('security/404.html.twig', [
            'user' => $this->user
        ]);
    }
}