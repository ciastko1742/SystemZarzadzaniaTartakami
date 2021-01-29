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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cart", inversedBy="offers")
     */
    private $cart;

    /**
     * @return mixed
     */
    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    /**
     * @param Cart|null $cart
     * @return Offer
     */
    public function setCart(?Cart $cart): self
    {
        $this->cart = $cart;
        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

}
