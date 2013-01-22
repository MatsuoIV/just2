<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="venue")
 * @ORM\Entity()
 */
class Venue {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @ORM\Column(type="string", length=255, nullable=false) */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="DateJust", mappedBy="Venue")
     */
    protected $dateJusts;

    /**
     * @ORM\ManyToOne(targetEntity="JVJ\UtilBundle\Entity\Country")
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="JVJ\UtilBundle\Entity\Department")
     */
    private $department;

    /**
     * @ORM\ManyToOne(targetEntity="JVJ\UtilBundle\Entity\District")
     */
    private $district;

    /**
     * @ORM\ManyToOne(targetEntity="JVJ\UtilBundle\Entity\Suburb")
     */
    private $suburb;

    /** @ORM\Column(type="string", length=255, nullable=false) */
    private $address;

    /**
     * @var string $correo
     *
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email()
     */
    private $mail;

    /** @ORM\Column(type="string", length=255, nullable=false) */
    private $phone;

    /** @ORM\Column(type="string", length=255, nullable=false) */
    private $contact;

    /** @ORM\Column(type="string", length=255, nullable=false) */
    private $image;

    /** @ORM\Column(type="string", length=255, nullable=false) */
    private $details;

    /** @ORM\Column(type="decimal", scale=6) */
    private $lat;

    /** @ORM\Column(type="decimal", scale=6) */
    private $long;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dates = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Venue
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
     * Set address
     *
     * @param string $address
     * @return Venue
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
     * Set mail
     *
     * @param string $mail
     * @return Venue
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    
        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Venue
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set contact
     *
     * @param string $contact
     * @return Venue
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    
        return $this;
    }

    /**
     * Get contact
     *
     * @return string 
     */
    public function getContact()
    {
        return $this->contact;
    }


    /**
     * Set country
     *
     * @param \JVJ\UtilBundle\Entity\Country $country
     * @return Venue
     */
    public function setCountry(\JVJ\UtilBundle\Entity\Country $country = null)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return \JVJ\UtilBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set department
     *
     * @param \JVJ\UtilBundle\Entity\Department $department
     * @return Venue
     */
    public function setDepartment(\JVJ\UtilBundle\Entity\Department $department = null)
    {
        $this->department = $department;
    
        return $this;
    }

    /**
     * Get department
     *
     * @return \JVJ\UtilBundle\Entity\Department 
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set district
     *
     * @param \JVJ\UtilBundle\Entity\District $district
     * @return Venue
     */
    public function setDistrict(\JVJ\UtilBundle\Entity\District $district = null)
    {
        $this->district = $district;
    
        return $this;
    }

    /**
     * Get district
     *
     * @return \JVJ\UtilBundle\Entity\District 
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set suburb
     *
     * @param \JVJ\UtilBundle\Entity\Suburb $suburb
     * @return Venue
     */
    public function setSuburb(\JVJ\UtilBundle\Entity\Suburb $suburb = null)
    {
        $this->suburb = $suburb;
    
        return $this;
    }

    /**
     * Get suburb
     *
     * @return \JVJ\UtilBundle\Entity\Suburb 
     */
    public function getSuburb()
    {
        return $this->suburb;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Venue
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set details
     *
     * @param string $details
     * @return Venue
     */
    public function setDetails($details)
    {
        $this->details = $details;
    
        return $this;
    }

    /**
     * Get details
     *
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Add dateJusts
     *
     * @param \Just2\BackendBundle\Entity\DateJust $dateJusts
     * @return Venue
     */
    public function addDateJust(\Just2\BackendBundle\Entity\DateJust $dateJusts)
    {
        $this->dateJusts[] = $dateJusts;
    
        return $this;
    }

    /**
     * Remove dateJusts
     *
     * @param \Just2\BackendBundle\Entity\DateJust $dateJusts
     */
    public function removeDateJust(\Just2\BackendBundle\Entity\DateJust $dateJusts)
    {
        $this->dateJusts->removeElement($dateJusts);
    }

    /**
     * Get dateJusts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDateJusts()
    {
        return $this->dateJusts;
    }

    /**
     * Set lat
     *
     * @param float $lat
     * @return Venue
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
     * @return Venue
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