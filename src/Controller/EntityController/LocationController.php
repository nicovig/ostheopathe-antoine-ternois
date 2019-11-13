<?php

namespace App\Controller\EntityController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LocationController extends AbstractController
{
    public function __construct(TokenStorageInterface $tokenStorage){
        $this->user = $tokenStorage->getToken()->getUser();
    }

    /**
     * @Route("/manage-location", name="location.edit")
     * @return Response
     */
    public function edit():Response{
        return $this->render('manage/location.html.twig', [
            'user' => $this->user
        ]);
    }

    /**
     * @Route("/cabinets", name="location.show")
     * @return Response
     */
    public function show():Response{
        return $this->render('pages/location.html.twig', [
            'user' => $this->user
        ]);
    }
}
