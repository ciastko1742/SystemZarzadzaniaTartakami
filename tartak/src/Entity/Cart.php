<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $offer_price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $transport_price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $final_price;

    /**
     * @ORM\Column(type="date")
     */
    private $date_add;

    /**
     * @ORM\Column(type="boolean")
     */
    private $ordered=0;

    /**
     * @return mixed
     */
    public function getOrdered()
    {
        return $this->ordered;
    }

    /**
     * @param mixed $ordered
     */
    public function setOrdered($ordered): void
    {
        $this->ordered = $ordered;
    }

    private $orders;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Offer", mappedBy="cart")
     */
    private $offers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="carts")
     */
    private $user;

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


    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->offers = new ArrayCollection();
    }

    public function getOffers() : Collection
    {
        return $this->offers;
    }

    public function getOrders() : Collection
    {
        return $this->orders;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOfferPrice()
    {
        return $this->offer_price;
    }

    public function setOfferPrice($offer_price): void
    {
        $this->offer_price = $offer_price;
    }

    public function getTransportPrice()
    {
        return $this->transport_price;
    }

    public function setTransportPrice($transport_price): void
    {
        $this->transport_price = $transport_price;
    }

    public function getFinalPrice()
    {
        return $this->final_price;
    }

    public function setFinalPrice($final_price): void
    {
        $this->final_price = $final_price;
    }

    public function getDateAdd()
    {
        return $this->date_add;
    }

    public function setDateAdd($date_add): void
    {
        $this->date_add = $date_add;
    }
}
