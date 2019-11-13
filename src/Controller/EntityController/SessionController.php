<?php

namespace App\Controller\EntityController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SessionController extends AbstractController
{
    public function __construct(TokenStorageInterface $tokenStorage){
        $this->user = $tokenStorage->getToken()->getUser();
    }

    /**
     * @Route("/séances", name="session.show")
     * @return Response
     */
    public function show():Response{
        return $this->render('pages/session.html.twig', [
            'user' => $this->user
        ]);
    }

    /**
     * @Route("/manage-session", name="session.edit")
     * @return Response
     */
    public function edit():Response{
        return $this->render('manage/session.html.twig', [
            'user' => $this->user
        ]);
    }
}
