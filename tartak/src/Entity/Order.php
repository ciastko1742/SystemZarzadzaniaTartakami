<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
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
    private $id_cart;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getIdCart()
    {
        return $this->id_cart;
    }
    public function setIdCart($id_cart): void
    {
        $this->id_cart = $id_cart;
    }
}
