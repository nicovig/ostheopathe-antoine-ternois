<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SecretaryRepository")
 */
class Secretary
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
    private $isLeader;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsLeader(): ?bool
    {
        return $this->isLeader;
    }

    public function setIsLeader(bool $isLeader): self
    {
        $this->isLeader = $isLeader;

        return $this;
    }
}
