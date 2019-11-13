<?php

namespace App\Controller\EntityController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class PrescriptionController extends AbstractController
{
    public function __construct(TokenStorageInterface $tokenStorage){
        $this->user = $tokenStorage->getToken()->getUser();
    }

    /**
     * @Route("/mes-ordonnances", name="prescription.show")
     * @return Response
     */
    public function show():Response{
        return $this->render('pages/prescription-patient.html.twig', [
            'user' => $this->user
        ]);
    }
}
