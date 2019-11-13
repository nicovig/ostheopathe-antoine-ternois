<?php

namespace App\Controller\EntityController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class PatientController extends AbstractController
{
    public function __construct(TokenStorageInterface $tokenStorage){
        $this->user = $tokenStorage->getToken()->getUser();
    }

    /**
     * @Route("/manage-patient", name="patient.edit")
     * @return Response
     */
    public function edit():Response{
        return $this->render('manage/patient.html.twig', [
            'user' => $this->user
        ]);
    }

    /**
     * @Route("/manage-patient-prescription", name="patient.prescription.edit")
     * @return Response
     */
    public function editPrescription():Response{
        return $this->render('manage/patient-prescription.html.twig', [
            'user' => $this->user
        ]);
    }

    /**
     * @Route("/view-prescription", name="patient.prescription.show")
     * @return Response
     */
    public function showPrescription():Response{
        return $this->render('pages/prescription-professionnal.html.twig', [
            'user' => $this->user
        ]);
    }

}
