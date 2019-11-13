<?php

namespace App\Controller;

use App\Entity\DTO\RightsDTO;
use App\Entity\Patient;
use App\Entity\Role;
use App\Form\PatientType;
use App\Helpers\AppHelpers;
use App\Repository\PatientRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AccountController extends AbstractController
{

    /**
     * @var PatientRepository
     */
    private $repository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(PatientRepository $repository,
                                ObjectManager $em,
                                AppHelpers $helpers,
                                TokenStorageInterface $tokenStorage){

        $this->repository = $repository;
        $this->em = $em;
        $this->helpers = $helpers;
        $this->user = $tokenStorage->getToken()->getUser();
    }


    /**
     * @Route("/moncompte", name="account.show")
     * @return Response
     */
    public function index():Response{
            return $this->render('account/index.html.twig', [
                'user' => $this->user
            ]);
    }

    /**
     * @Route("/créer-compte", name="account.create")
     */
    public function create(Request $request)
    {
        if($this->user){
            return $this->render('account/already-account.html.twig', [
                'user' => $this->user
            ]);
        }

        $patient = new Patient();
        $date = $this->helpers->now();

        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            // 1. Job (Patient, Secretary, Practitioner)
            $patient->setCreatedAt($date);
            // 2. Role
            $role = new Role();
            $role->setPatient($patient);
            // 3. Right
            $dto = new RightsDTO();
            $rights = $dto->patientRightsDTO($role);
            // (4. User)
            //User Object from form
            $userData = $form->get('user')->getNormData();
            $user = $this->helpers->properUserObject($userData, $role);
            $user->setIsActive(true);

            // Doctrine
            $this->em->persist($patient);
            $this->em->persist($role);
            $this->em->persist($rights);
            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success', 'Compte crée avec succès.');
            return $this->redirectToRoute('home');
        }

        return $this->render('account/create.html.twig', [
            'patient' => $patient,
            'form' => $form->createView()
        ]);

    }

}