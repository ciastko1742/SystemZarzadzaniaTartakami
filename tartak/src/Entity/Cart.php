<?php

namespace App\Entity;

use App\Repository\CartRepository;
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
     * @ORM\Column(type="integer")
     */
    private $id_offer;

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

    public function getId(): ?int
    {
        return $this->id;
    }
}
