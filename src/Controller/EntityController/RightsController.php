<?php

namespace App\Controller\EntityController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RightsController extends AbstractController
{
    public function __construct(TokenStorageInterface $tokenStorage){
        $this->user = $tokenStorage->getToken()->getUser();
    }

    /**
     * @Route("/manage-rights", name="rights.edit")
     * @return Response
     */
    public function edit():Response{
        return $this->render('manage/rights.html.twig', [
            'user' => $this->user
        ]);
    }
}
