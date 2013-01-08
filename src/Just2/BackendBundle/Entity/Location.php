<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="")
 * @ORM\Entity()
 */

class Location
{
    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
 
    /**
     * @ORM\ManyToOne(targetEntity="Province", inversedBy="locations")
     * @ORM\JoinColumn(name="province_id", referencedColumnName="id")
     */
    protected $province;
 
    /**
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    protected $address;
 
     /**
     * @var string $zipcode
     *
     * @ORM\Column(name="zipcode", type="string", length=20, nullable=true)
     */
    protected $zipCode;

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
     * Set address
     *
     * @param string $address
     * @return Location
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     * @return Location
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    
        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string 
     */
    public function getZipcode()
    {
        return $this->zipcode;
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
