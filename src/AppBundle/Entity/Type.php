<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type
 *
 * @ORM\Table(name="type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TypeRepository")
 */
class Type
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Videogame", mappedBy="type")
     */
    private $videogames;
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
     * Set type
     *
     * @param string $type
     *
     * @return Type
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->videogames = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Type
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add videogame
     *
     * @param \AppBundle\Entity\Videogame $videogame
     *
     * @return Type
     */
    public function addVideogame(\AppBundle\Entity\Videogame $videogame)
    {
        $this->videogames[] = $videogame;

        return $this;
    }

    /**
     * Remove videogame
     *
     * @param \AppBundle\Entity\Videogame $videogame
     */
    public function removeVideogame(\AppBundle\Entity\Videogame $videogame)
    {
        $this->videogames->removeElement($videogame);
    }

    /**
     * Get videogames
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVideogames()
    {
        return $this->videogames;
    }

    public function __toString()
    {
        return $this->name;
    }
}
