<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Platform
 *
 * @ORM\Table(name="platform")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlatformRepository")
 */
class Platform
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
     * @var [Videogame]
     *
     * @ORM\OneToMany(targetEntity="Videogame", mappedBy="platform")
     */
    private $videogames;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

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
     * Set name
     *
     * @param string $name
     *
     * @return Platform
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
     * Set videogames
     *
     * @param \AppBundle\Entity\Videogame $videogames
     *
     * @return Platform
     */
    public function setVideogames(\AppBundle\Entity\Videogame $videogames = null)
    {
        $this->videogames = $videogames;

        return $this;
    }

    /**
     * Get videogames
     *
     * @return \AppBundle\Entity\Videogame
     */
    public function getVideogames()
    {
        return $this->videogames;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->videogames = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add videogame
     *
     * @param \AppBundle\Entity\Videogame $videogame
     *
     * @return Platform
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

    public function __toString()
    {
        return $this->name;
    }
}
