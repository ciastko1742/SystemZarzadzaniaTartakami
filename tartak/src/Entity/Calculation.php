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


    /**
     * @return mixed
     */
    public function getMaterial() : ?Material
    {
        return $this->material;
    }

    /**
     * @param mixed $material
     */
    public function setMaterial($material): void
    {
        $this->material = $material;
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
        $this->quantity = $quantity;
	}

    public function getPrice()
    {
        return $this->price/100;
    }

    public function setPrice($price): void
    {
        $this->price = $price*100;
	}


    /**
     * @return float|null
     */
	public function countPrice(): ?float
    {
        if($this->material && $this->height && $this->width
        && $this->length && $this->quantity){
           $cbm = ($this->height/100) * ($this->width/100) * ($this->length/100);
           $price = $this->quantity * $cbm * $this->getMaterial()->getPriceM3();
            return round($price, 2);
        }
        return null;
    }
}
