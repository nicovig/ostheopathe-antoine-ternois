<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RightsRepository")
 */
class Rights
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canUpdateAppointment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canUpdateLocation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canUpdatePatient;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canUpdatePractitioner;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canUpdatePrescription;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canUpdateSecretary;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canUpdateSession;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canSeeLocation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canSeePractitioner;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canSeeSecretary;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canSeeSession;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canUpdateHisAppointment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canUpdateHisPatient;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canSeeHisPrescription;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="rights")
     * @ORM\JoinColumn(nullable=false)
     */
    private $role;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCanUpdateAppointment(): ?bool
    {
        return $this->canUpdateAppointment;
    }

    public function setCanUpdateAppointment(bool $canUpdateAppointment): self
    {
        $this->canUpdateAppointment = $canUpdateAppointment;

        return $this;
    }

    public function getCanUpdateLocation(): ?bool
    {
        return $this->canUpdateLocation;
    }

    public function setCanUpdateLocation(bool $canUpdateLocation): self
    {
        $this->canUpdateLocation = $canUpdateLocation;

        return $this;
    }

    public function getCanUpdatePatient(): ?bool
    {
        return $this->canUpdatePatient;
    }

    public function setCanUpdatePatient(bool $canUpdatePatient): self
    {
        $this->canUpdatePatient = $canUpdatePatient;

        return $this;
    }

    public function getCanUpdatePractitioner(): ?bool
    {
        return $this->canUpdatePractitioner;
    }

    public function setCanUpdatePractitioner(bool $canUpdatePractitioner): self
    {
        $this->canUpdatePractitioner = $canUpdatePractitioner;

        return $this;
    }

    public function getCanUpdatePrescription(): ?bool
    {
        return $this->canUpdatePrescription;
    }

    public function setCanUpdatePrescription(bool $canUpdatePrescription): self
    {
        $this->canUpdatePrescription = $canUpdatePrescription;

        return $this;
    }

    public function getCanUpdateSecretary(): ?bool
    {
        return $this->canUpdateSecretary;
    }

    public function setCanUpdateSecretary(bool $canUpdateSecretary): self
    {
        $this->canUpdateSecretary = $canUpdateSecretary;

        return $this;
    }

    public function getCanUpdateSession(): ?bool
    {
        return $this->canUpdateSession;
    }

    public function setCanUpdateSession(bool $canUpdateSession): self
    {
        $this->canUpdateSession = $canUpdateSession;

        return $this;
    }

    public function getCanSeeLocation(): ?bool
    {
        return $this->canSeeLocation;
    }

    public function setCanSeeLocation(bool $canSeeLocation): self
    {
        $this->canSeeLocation = $canSeeLocation;

        return $this;
    }

    public function getCanSeePractitioner(): ?bool
    {
        return $this->canSeePractitioner;
    }

    public function setCanSeePractitioner(bool $canSeePractitioner): self
    {
        $this->canSeePractitioner = $canSeePractitioner;

        return $this;
    }

    public function getCanSeeSecretary(): ?bool
    {
        return $this->canSeeSecretary;
    }

    public function setCanSeeSecretary(bool $canSeeSecretary): self
    {
        $this->canSeeSecretary = $canSeeSecretary;

        return $this;
    }

    public function getCanSeeSession(): ?bool
    {
        return $this->canSeeSession;
    }

    public function setCanSeeSession(bool $canSeeSession): self
    {
        $this->canSeeSession = $canSeeSession;

        return $this;
    }

    public function getCanUpdateHisAppointment(): ?bool
    {
        return $this->canUpdateHisAppointment;
    }

    public function setCanUpdateHisAppointment(bool $canUpdateHisAppointment): self
    {
        $this->canUpdateHisAppointment = $canUpdateHisAppointment;

        return $this;
    }

    public function getCanUpdateHisPatient(): ?bool
    {
        return $this->canUpdateHisPatient;
    }

    public function setCanUpdateHisPatient(bool $canUpdateHisPatient): self
    {
        $this->canUpdateHisPatient = $canUpdateHisPatient;

        return $this;
    }

    public function getCanSeeHisPrescription(): ?bool
    {
        return $this->canSeeHisPrescription;
    }

    public function setCanSeeHisPrescription(bool $canSeeHisPrescription): self
    {
        $this->canSeeHisPrescription = $canSeeHisPrescription;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }
}
