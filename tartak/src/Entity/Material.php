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
     * @ORM\Column(type="integer")
     */
    private $id_type;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $priceM3;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getIdType()
    {
        return $this->id_type;
    }
    public function setIdType($id_type): void
    {
        $this->id_type = $id_type;
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
