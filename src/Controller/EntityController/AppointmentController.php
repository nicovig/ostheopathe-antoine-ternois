<?php

namespace App\Controller\EntityController;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Entity\Appointment;
use App\Form\AppointmentType;
use App\Repository\AppointmentRepository;
use App\Helpers\AppHelpers;
use Symfony\Component\HttpFoundation\Request;

class AppointmentController extends AbstractController
{

    public function __construct(AppHelpers $helpers,
                                TokenStorageInterface $tokenStorage
                                ){                         
        $this->helpers = $helpers;
        $this->user = $tokenStorage->getToken()->getUser();
    }

    /*#############################  PATIENT ###############################################*/

    /**
     * @Route("/prendre-rendez-vous", name="appointment.patient.show.availability")
     * @return Response
     */
    public function showCalendarAvailability():Response{
        return $this->render('pages/appointment/availability-show.html.twig', [
            'user' => $this->user
        ]);
    }

    /**
     * @Route("/mes-rendez-vous", name="appointment.patient.show.his")
     * @return Response
     */
    public function showCalendarPatientHisAppointments():Response{
        return $this->render('pages/appointment/show-his-appointments.html.twig', [
            'user' => $this->user
        ]);
    }

    /**
     * @Route("/créer-rendez-vous", name="appointment.patient.create", methods={"GET","POST"})
     */
    public function createPatientAppointment(Request $request): Response
    {
        $appointment = new Appointment();
        $form = $this->createForm(AppointmentType::class, $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //Form's data = session, location, reason, practitioner
            //Data send by calendar = date
            $date = new \DateTime('2019-12-1 17:00:00');
            $appointment->setDate($date);

            //Data to set auto = createdAt, patient
            $appointment->setCreatedAt($this->helpers->now());
            $patient = $this->helpers->getPatient($this->user);
            $appointment->setPatient($patient);
            dump($appointment);
            //Data calculated = endAt   
            $appointment->setEndAt($this->helpers->getEndAppointment($appointment->getDate(), 
                                                                     $appointment->getSession()->getAverageDuration())
                                                                     );
            //if (tokenConfirmation == true) { ... }
            //IS_ACTIVE
            $appointment->setIsActive(true);
            //#############################################################"
            dump($appointment);
            $entityManager->persist($appointment);
            $entityManager->flush();

            return $this->redirectToRoute('appointment.patient.show.his');
        }

        return $this->render('pages/appointment/create.html.twig', [
            'user' => $this->user,
            'appointment' => $appointment,
            'form' => $form->createView(),
        ]);
    }

    /*############################# MANAGE ###############################################*/

    /**
     * @Route("/manage-rendez-vous-agenda", name="appointment.manage.show", methods={"GET"})
     * @return Response
     */
    public function showCalendarManage(AppointmentRepository $appointmentRepository):Response{
        return $this->render('manage/appointment/show.html.twig', [
            'appointments' => $appointmentRepository->findAll(),
            'user' => $this->user
        ]);
    }

    /**
     * @Route("/manage-créer-rendez-vous", name="appointment.manage.create", methods={"GET","POST"})
     */
    public function createManageAppointment(Request $request): Response
    {
        $appointment = new Appointment();
        $form = $this->createForm(AppointmentType::class, $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($appointment);
            $entityManager->flush();

            return $this->redirectToRoute('appointment.manage.show');
        }

        return $this->render('manage/appointment/create.html.twig', [
            'appointment' => $appointment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/manage-rendez-vous/{id}", name="appointment.manage.show.one", methods={"GET"})
     */
    public function showOneAppointment(Appointment $appointment): Response
    {
        return $this->render('manage/appointment/show-one.html.twig', [
            'appointment' => $appointment,
        ]);
    }

    /**
     * @Route("/manage-edit-rendez-vous/{id}", name="appointment.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Appointment $appointment): Response
    {
        $form = $this->createForm(AppointmentType::class, $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appointment.manage.show');
        }

        return $this->render('/manage/appointment/edit.html.twig', [
            'appointment' => $appointment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/manage-rendez-vous/{id}", name="appointment.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Appointment $appointment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$appointment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($appointment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('appointment.manage.show');
    }



}
