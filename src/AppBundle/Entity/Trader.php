<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trader
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TraderRepository")
 */
class Trader extends Person
{
    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=255)
     */
    private $job;

    /**
     * Set job
     *
     * @param string $job
     *
     * @return Trader
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }
}

