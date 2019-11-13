<?php

namespace App\Controller\EntityController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AppointmentController extends AbstractController
{
    public function __construct(TokenStorageInterface $tokenStorage){
        $this->user = $tokenStorage->getToken()->getUser();
    }

    /**
     * @Route("/prendre-rendez-vous", name="appointment.create")
     * @return Response
     */
    public function create():Response{
        return $this->render('pages/appointment-create.html.twig', [
            'user' => $this->user
        ]);
    }

    /**
     * @Route("/mes-rendez-vous", name="appointment.show")
     * @return Response
     */
    public function show():Response{
        return $this->render('pages/appointment-show.html.twig', [
            'user' => $this->user
        ]);
    }

    /**
     * @Route("/manage-appointment", name="appointment.edit")
     * @return Response
     */
    public function edit():Response{
        return $this->render('manage/appointment.html.twig', [
            'user' => $this->user
        ]);
    }
}
