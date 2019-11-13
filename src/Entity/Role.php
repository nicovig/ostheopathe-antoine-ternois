<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rights", mappedBy="role")
     */
    private $rights;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Secretary", cascade={"persist", "remove"})
     */
    private $secretary;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Practitioner", cascade={"persist", "remove"})
     */
    private $practitioner;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Patient", cascade={"persist", "remove"})
     */
    private $patient;

    public function __construct()
    {
        $this->rights = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Rights[]
     */
    public function getRights(): Collection
    {
        return $this->rights;
    }

    public function addRight(Rights $right): self
    {
        if (!$this->rights->contains($right)) {
            $this->rights[] = $right;
            $right->setRole($this);
        }

        return $this;
    }

    public function removeRight(Rights $right): self
    {
        if ($this->rights->contains($right)) {
            $this->rights->removeElement($right);
            // set the owning side to null (unless already changed)
            if ($right->getRole() === $this) {
                $right->setRole(null);
            }
        }

        return $this;
    }

    public function getSecretary(): ?Secretary
    {
        return $this->secretary;
    }

    public function setSecretary(?Secretary $secretary): self
    {
        $this->secretary = $secretary;

        return $this;
    }

    public function getPractitioner(): ?Practitioner
    {
        return $this->practitioner;
    }

    public function setPractitioner(?Practitioner $practitioner): self
    {
        $this->practitioner = $practitioner;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }
}
