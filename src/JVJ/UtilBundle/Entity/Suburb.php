<?php

namespace JVJ\UtilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="jvj_suburb")
 * @ORM\Entity()
 */
class Suburb {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $name;

    /** @ORM\Column(type="decimal", scale=6) */
    private $lat;

    /** @ORM\Column(type="decimal", scale=6) */
    private $long;

    /**
     * @ORM\ManyToOne(targetEntity="JVJ\UtilBundle\Entity\District")
     */
    private $District;

    public function __toString() {
        return $this->getName();
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
     * Set name
     *
     * @param string $name
     * @return Suburb
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
     * Set District
     *
     * @param \JVJ\UtilBundle\Entity\District $district
     * @return Suburb
     */
    public function setDistrict(\JVJ\UtilBundle\Entity\District $district = null)
    {
        $this->district = $district;
    
        return $this;
    }

    /**
     * Get District
     *
     * @return \JVJ\UtilBundle\Entity\District 
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set lat
     *
     * @param float $lat
     * @return Suburb
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    
        return $this;
    }

    /**
     * Get lat
     *
     * @return float 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set long
     *
     * @param float $long
     * @return Suburb
     */
    public function setLong($long)
    {
        $this->long = $long;
    
        return $this;
    }

    /**
     * Get long
     *
     * @return float 
     */
    public function getLong()
    {
        return $this->long;
    }
}