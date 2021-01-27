<?php

namespace App\Entity;

use App\Repository\CalculationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CalculationRepository::class)
 */
class Calculation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Material", inversedBy="calculations")
     */
    private $material;

    /**
     * @ORM\Column(type="integer")
     */
    private $length;

    /**
     * @ORM\Column(type="integer")
     */
    private $width;

    /**
     * @ORM\Column(type="integer")
     */
    private $height;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    private $offers;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }

    public function getOffers() : Collection
    {
        return $this->offers;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getIdMaterial()
    {
        return $this->id_material;
    }
    public function setIdMaterial($id_material): void
    {
        $this->id_material = $id_material;
	}
    public function getLength()
    {
        return $this->length;
    }
    public function setLength($length): void
    {
        $this->length = $length;
	}
    public function getWidth()
    {
        return $this->width;
    }
    public function setWidth($width): void
    {
        $this->width = $width;
	}
    public function getHeight()
    {
        return $this->height;
    }
    public function setHeight($height): void
    {
        $this->height = $height;
	}
    public function getQuantity()
    {
        return $this->quantity;
    }
    public function setQuantity($quantity): void
    {
        $this->quntity = $quantity;
	}
    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($price): void
    {
        $this->price = $price;
	}
}
