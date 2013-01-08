<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
// use JVJ\UserBundle\Entity\User;

class Province
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;
 
    /**
     * @ORM\Column(type="string", length="255", nullable=false)
     */
    private $name;
 
   /**
     * Inverse Side
     * @ORM\OneToMany(targetEntity="Locality", mappedBy="province")
     */
    private $localities;

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
     * @return Province
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
     * Set localities
     *
     * @param \Just2\BackendBundle\Entity\Locality $localities
     * @return Province
     */
    public function setLocalities(\Just2\BackendBundle\Entity\Locality $localities = null)
    {
        $this->localities = $localities;
    
        return $this;
    }

    /**
     * Get localities
     *
     * @return \Just2\BackendBundle\Entity\Locality 
     */
    public function getLocalities()
    {
        return $this->localities;
    }
}