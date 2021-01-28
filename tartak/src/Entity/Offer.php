<?php

namespace App\Entity;

use App\Repository\OfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OfferRepository::class)
 */
class Offer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Calculation", inversedBy="offers")
     */
    private $calculation;

    /**
     * @return mixed
     */
    public function getCalculation()
    {
        return $this->calculation;
    }

    /**
     * @param mixed $calculation
     */
    public function setCalculation($calculation): void
    {
        $this->calculation = $calculation;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="offers")
     */
    private $user;

    private $carts;

    public function __construct()
    {
        $this->carts = new ArrayCollection();
    }

    public function getCarts() : Collection
    {
        return $this->Carts;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getIdCalculation()
    {
        return $this->id_calculation;
    }
    public function setIdCalculation($id_calculation): void
    {
        $this->id_calculation = $id_calculation;
	}
    public function getIdUser()
    {
        return $this->id_user;
    }
    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
	}
}
