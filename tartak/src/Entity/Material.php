<?php

namespace App\Entity;

use App\Repository\MaterialRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaterialRepository::class)
 */
class Material
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $priceM3;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="products")
     */
    private $type;

    /**
     * @return mixed
     */
    public function getTypes() : ?Type
    {
        return $this->type;
    }

    /**
     * @param Type|null $type
     * @return $this
     */
    public function setTypes(?Type $type): self
    {
        $this->type = $type;
        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setName($name): void
    {
        $this->name = $name;
    }
    public function getPriceM3()
    {
        return $this->priceM3;
    }
    public function setPriceM3($priceM3): void
    {
        $this->priceM3 = $priceM3;
    }
}
