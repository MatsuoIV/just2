<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Just2\BackendBundle\Entity\OcassionVenue
 *
 * @ORM\Table(name="ocassionvenue")
 * @ORM\Entity 
 */
class OcassionVenue
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Just2\BackendBundle\Entity\Ocassion")
     */
    private $ocassion;

    /**
     * @ORM\ManyToOne(targetEntity="Just2\BackendBundle\Entity\Venue")
     */
    private $venue;


    public function __toString()
    {
        return $this->getOcassion()->getName();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ocassion
     *
     * @param Just2\BackendBundle\Entity\Ocassion $ocassion
     * @return OcassionVenue
     */
    public function setOcassion(Just2\BackendBundle\Entity\Ocassion $ocassion = null)
    {
        $this->ocassion = $ocassion;
    
        return $this;
    }

    /**
     * Get ocassion
     *
     * @return Just2\BackendBundle\Entity\Ocassion 
     */
    public function getOcassion()
    {
        return $this->ocassion;
    }

    /**
     * Set venue
     *
     * @param Just2\BackendBundle\Entity\Venue $venue
     * @return OcassionVenue
     */
    public function setVenue(Just2\BackendBundle\Entity\Venue $venue = null)
    {
        $this->venue = $venue;
    
        return $this;
    }

    /**
     * Get venue
     *
     * @return Just2\BackendBundle\Entity\Venue 
     */
    public function getVenue()
    {
        return $this->venue;
    }
}
