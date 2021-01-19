<?php

namespace App\Entity;

use App\Repository\OfferRepository;
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
     * @ORM\Column(type="integer")
     */
    private $id_calculation;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_user;

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
