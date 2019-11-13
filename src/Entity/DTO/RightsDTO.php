<?php


namespace App\Entity\DTO;


use App\Entity\Rights;
use App\Entity\Role;

class RightsDTO
{

    public function patientRightsDTO(Role $role){

        $right = new Rights();

        $right->setRole($role)
            ->setCanUpdateAppointment(false)
            ->setCanUpdateLocation(false)
            ->setCanUpdatePatient(false)
            ->setCanUpdatePractitioner(false)
            ->setCanUpdatePrescription(false)
            ->setCanUpdateSecretary(false)
            ->setCanUpdateSession(false)
            ->setCanSeeLocation(true)
            ->setCanSeePractitioner(true)
            ->setCanSeeSecretary(true)
            ->setCanSeeSession(true)
            ->setCanUpdateHisAppointment(true)
            ->setCanUpdateHisPatient(true)
            ->setCanSeeHisPrescription(true);

        return $right;
    }


}