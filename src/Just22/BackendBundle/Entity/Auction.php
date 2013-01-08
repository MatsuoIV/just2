<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="auction")
 * @ORM\Entity()
 */
Class Auction {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="DateJust")
     */
    private $dateJust;

    /** @ORM\Column(type="string", length=255) */
    private $reservation;

    /**
     * @ORM\Column(name="monto", type="decimal", scale=2, nullable=false)
     * 
     * @Assert\Regex(pattern="/^[0-9]+(\.\d{1,2})?$/",message="Monto incorrecto.")
     * @Assert\Type(type="float")
     * @Assert\Range(min = 0)
     */
    private $winningBid;

    /**
     * @ORM\ManyToOne(targetEntity="Member")
     */
    private $winningMember;

    /**
     * @ORM\Column(type="smallint")
     */
    private $state;


    public function __toString()
    {
        return $this->getDateJust();
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
     * Set reservation
     *
     * @param string $reservation
     * @return Auction
     */
    public function setReservation($reservation)
    {
        $this->reservation = $reservation;
    
        return $this;
    }

    /**
     * Get reservation
     *
     * @return string 
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Set winningBid
     *
     * @param float $winningBid
     * @return Auction
     */
    public function setWinningBid($winningBid)
    {
        $this->winningBid = $winningBid;
    
        return $this;
    }

    /**
     * Get winningBid
     *
     * @return float 
     */
    public function getWinningBid()
    {
        return $this->winningBid;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return Auction
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }

  

    /**
     * Set winningMember
     *
     * @param \Just2\BackendBundle\Entity\Member $winningMember
     * @return Auction
     */
    public function setWinningMember(\Just2\BackendBundle\Entity\Member $winningMember = null)
    {
        $this->winningMember = $winningMember;
    
        return $this;
    }

    /**
     * Get winningMember
     *
     * @return \Just2\BackendBundle\Entity\Member 
     */
    public function getWinningMember()
    {
        return $this->winningMember;
    }

 

    /**
     * Set dateJust
     *
     * @param \Just2\BackendBundle\Entity\DateJust $dateJust
     * @return Auction
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