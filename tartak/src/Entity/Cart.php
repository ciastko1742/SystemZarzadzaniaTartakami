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
     * @ORM\ManyToOne(targetEntity="App\Entity\Offer", inversedBy="carts")
     */
    private $offer;

    /**
     * @ORM\Column(type="integer")
     */
    private $offer_price;

    /**
     * @ORM\Column(type="integer")
     */
    private $transport_price;

    /**
     * @ORM\Column(type="integer")
     */
    private $final_price;

    /**
     * @ORM\Column(type="date")
     */
    private $date_add;

    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getOrders() : Collection
    {
        return $this->orders;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getIdOffer()
    {
        return $this->id_offer;
    }
    public function setIdOffer($id_offer): void
    {
        $this->id_offer = $id_offer;
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
    public function getFianlPrice()
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
    public function setName($date_add): void
    {
        $this->date_add = $date_add;
    }
}
