<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Videogame
 *
 * @ORM\Table(name="videogame")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VideogameRepository")
 */
class Videogame
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Platform", inversedBy="videogames")
     */
    private $platform;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="videogames")
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="stock", type="integer")
     */
    private $stock;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="boughtVideogames")
     */
    private $buyer;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="selledVideogames")
     */
    private $seller;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Videogame
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Videogame
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     *
     * @return Videogame
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set buyer
     *
     * @param string $buyer
     *
     * @return Videogame
     */
    public function setBuyer($buyer)
    {
        $this->buyer = $buyer;

        return $this;
    }

    /**
     * Get buyer
     *
     * @return string
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * Set seller
     *
     * @param string $seller
     *
     * @return Videogame
     */
    public function setSeller($seller)
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * Get seller
     *
     * @return string
     */
    public function getSeller()
    {
        return $this->seller;
    }

    public function __toString()
    {
        return $this->title;
    }

    /**
     * Set platform
     *
     * @param \AppBundle\Entity\Platform $platform
     *
     * @return Videogame
     */
    public function setPlatform(\AppBundle\Entity\Platform $platform = null)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * Get platform
     *
     * @return \AppBundle\Entity\Platform
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\Type $type
     *
     * @return Videogame
     */
    public function setType(\AppBundle\Entity\Type $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }
}
