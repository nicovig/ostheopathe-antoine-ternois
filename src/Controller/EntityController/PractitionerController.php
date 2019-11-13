<?php

namespace App\Controller\EntityController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class PractitionerController extends AbstractController
{
    public function __construct(TokenStorageInterface $tokenStorage){
        $this->user = $tokenStorage->getToken()->getUser();
    }

    /**
     * @Route("/manage-practitioner", name="practitioner.edit")
     * @return Response
     */
    public function edit():Response{
        return $this->render('manage/practitioner.html.twig', [
            'user' => $this->user
        ]);
    }

    /**
     * @Route("/praticiens", name="practitioner.show")
     * @return Response
     */
    public function show():Response{
        return $this->render('pages/practitioner.html.twig', [
            'user' => $this->user
        ]);
    }
}
