<?php

namespace App\Helpers;

use App\Entity\Role;
use App\Entity\User;
use App\Repository\PatientRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AppHelpers implements UserCheckerInterface
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    private $patientRepository;

    public function __construct(PatientRepository $patientRepository,
                                UserPasswordEncoderInterface $encoder){
        $this->patientRepository = $patientRepository;
        $this->encoder = $encoder;
    }
/*########################################################################*/

    /**
     * Checks the user account before authentication.
     *
     * @throws AccountStatusException
     */
    public function checkPreAuth(UserInterface $user){

    }

    /**
     * Checks the user account after authentication.
     *
     * @throws AccountStatusException
     */
    public function checkPostAuth(UserInterface $user){

    }

    /*
     * Param : appointment's date, average duration from the session
     * Return : endAt data, DateTime object
     * Uses : AppointmentController::createPatientAppointment
     *
     * */
    public function getEndAppointment($start, $duration){
        $endAt = new \DateTime();
        $endAt->setTimestamp($start->getTimestamp() + $duration->getTimestamp());
        return $endAt;
    }

    /*
     * Param : user object
     * Return : patient object
     * Uses : AppointmentController::createPatientAppointment
     *
     * */
    public function getPatient($user){
        $role = $user->getRole();
        $patientTmp = $role->getPatient();
        $patientId = $patientTmp->getId();
        $patient = $this->patientRepository->find($patientId);
        return $patient;
    }

    /*
     * Param : a UserData from form (User form embbed in form)
     * Return : proper User Object, with encoded password & good username (mail)
     * Uses : Account Controller
     *
     * */
    public function properUserObject(User $userData, Role $role){
        $properUser = new User();
        $properUser->setRole($role);
        $properUser->setLastName($userData->getLastName());
        $properUser->setFirstName($userData->getFirstName());
        $properUser->setPhone($userData->getPhone());
        $properUser->setMail($userData->getMail());
        $properUser->setUsername($userData->getMail());
        $properUser->setPassword($this->encoder->encodePassword($userData, $userData->getPassword()));
        return $properUser;
    }

    /*
     * Return : new DateTime object with actual date
     * Uses : AccountController, AppointmentController::createPatientAppointment
     *
     * */
    public function now(){
        $date = new \DateTime();
        return $date;
    }

}