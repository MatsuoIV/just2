<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="reservation")
 * @ORM\Entity()
 */
Class Reservation {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Venue")
     * @ORM\JoinColumn(name="venue_id", referencedColumnName="id")
     */
    private $venue;

    /**
     * @ORM\ManyToOne(targetEntity="DateJust")
     */
    private $dateJust;
    

    /** @ORM\Column(type="string", length=255, nullable=false) */
    private $codeReservation;

    /**
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $byDate;

    /**
     * @ORM\Column(type="smallint")
     */
    private $estate;




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
     * Set codeReservation
     *
     * @param string $codeReservation
     * @return Reservation
     */
    public function setCodeReservation($codeReservation)
    {
        $this->codeReservation = $codeReservation;
    
        return $this;
    }

    /**
     * Get codeReservation
     *
     * @return string 
     */
    public function getCodeReservation()
    {
        return $this->codeReservation;
    }

    /**
     * Set byDate
     *
     * @param \DateTime $byDate
     * @return Reservation
     */
    public function setByDate($byDate)
    {
        $this->byDate = $byDate;
    
        return $this;
    }

    /**
     * Get byDate
     *
     * @return \DateTime 
     */
    public function getByDate()
    {
        return $this->byDate;
    }

    /**
     * Set estate
     *
     * @param integer $estate
     * @return Reservation
     */
    public function setEstate($estate)
    {
        $this->estate = $estate;
    
        return $this;
    }

    /**
     * Get estate
     *
     * @return integer 
     */
    public function getEstate()
    {
        return $this->estate;
    }

    /**
     * Set venue
     *
     * @param \Just2\BackendBundle\Entity\Venue $venue
     * @return Reservation
     */
    public function setVenue(\Just2\BackendBundle\Entity\Venue $venue = null)
    {
        $this->venue = $venue;
    
        return $this;
    }

    /**
     * Get venue
     *
     * @return \Just2\BackendBundle\Entity\Venue 
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * Set date
     *
     * @param \Just2\BackendBundle\Entity\DateJust $date
     * @return Reservation
     */
    public function setDate(\Just2\BackendBundle\Entity\DateJust $date = null)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \Just2\BackendBundle\Entity\DateJust 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set dateJust
     *
     * @param \Just2\BackendBundle\Entity\DateJust $dateJust
     * @return Reservation
     */
    public function setDateJust(\Just2\BackendBundle\Entity\DateJust $dateJust = null)
    {
        $this->dateJust = $dateJust;
    
        return $this;
    }

    /**
     * Get dateJust
     *
     * @return \Just2\BackendBundle\Entity\DateJust 
     */
    public function getDateJust()
    {
        return $this->dateJust;
    }
}