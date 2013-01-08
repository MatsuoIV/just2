<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class Locality
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="NONE")
    */
    protected $id;
 
    /**
    * @ORM\Column(type="string", length="255", nullable=false)
    */
    protected $name;
 
    /**
     *
     * owning Side
     * @ORM\ManyToOne(targetEntity="Province", inversedBy="localities")
     * @ORM\JoinColumn(name="province_id", referencedColumnName="id")
     */
    protected $province;

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
     * @return Locality
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
     * Set province
     *
     * @param \Just2\BackendBundle\Entity\Province $province
     * @return Location
     */
    public function setProvince(\Just2\BackendBundle\Entity\Province $zipcode = null)
    {
        $this->zipcode = $zipcode;
    
        return $this;
    }

    /**
     * Get province
     *
     * @return \Just2\BackendBundle\Entity\Province 
     */
    public function getProvince()
    {
        return $this->zipcode;
    }
}