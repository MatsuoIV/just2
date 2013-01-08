<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="date_just")
 * @ORM\Entity()
 */
class DateJust {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="dateJusts")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */
    private $member;

    /**
     * @ORM\ManyToOne(targetEntity="Ocassion", inversedBy="dateJusts")
     * @ORM\JoinColumn(name="ocassion_id", referencedColumnName="id")
     */
    private $ocassion;

    /**
     * @ORM\Column(type="text")
     */
    private $detailDate;

    /**
     * @ORM\Column(name="minPrice", type="decimal", scale=2, nullable=false)
     * 
     * @Assert\Regex(pattern="/^[0-9]+(\.\d{1,2})?$/",message="incorrectly entered price.")
     * @Assert\Type(type="float")
     * @Assert\Range(min = 0)
     */
    private $minPrice;

    /**
     * @ORM\ManyToOne(targetEntity="Venue", inversedBy="dates")
     * @ORM\JoinColumn(name="venue_id", referencedColumnName="id")
     */
    private $venue;


    /**
     *  @var datetime $createdAt
     *
     * @ORM\Column(name="createdAt", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="Bid", mappedBy="date")
     */
    protected $bids;
    
    /**
     * @ORM\Column(type="smallint")
     */
    private $estate;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bids = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set detailDate
     *
     * @param string $detailDate
     * @return DateJust
     */
    public function setDetailDate($detailDate)
    {
        $this->detailDate = $detailDate;
    
        return $this;
    }

    /**
     * Get detailDate
     *
     * @return string 
     */
    public function getDetailDate()
    {
        return $this->detailDate;
    }

    /**
     * Set minPrice
     *
     * @param float $minPrice
     * @return DateJust
     */
    public function setMinPrice($minPrice)
    {
        $this->minPrice = $minPrice;
    
        return $this;
    }

    /**
     * Get minPrice
     *
     * @return float 
     */
    public function getMinPrice()
    {
        return $this->minPrice;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return DateJust
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return DateJust
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set estate
     *
     * @param integer $estate
     * @return DateJust
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
     * Set member
     *
     * @param \Just2\BackendBundle\Entity\Member $member
     * @return DateJust
     */
    public function setMember(\Just2\BackendBundle\Entity\Member $member = null)
    {
        $this->member = $member;
    
        return $this;
    }

    /**
     * Get member
     *
     * @return \Just2\BackendBundle\Entity\Member 
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Set ocassion
     *
     * @param \Just2\BackendBundle\Entity\Ocassion $ocassion
     * @return DateJust
     */
    public function setOcassion(\Just2\BackendBundle\Entity\Ocassion $ocassion = null)
    {
        $this->ocassion = $ocassion;
    
        return $this;
    }

    /**
     * Get ocassion
     *
     * @return \Just2\BackendBundle\Entity\Ocassion 
     */
    public function getOcassion()
    {
        return $this->ocassion;
    }

    /**
     * Set venue
     *
     * @param \Just2\BackendBundle\Entity\Venue $venue
     * @return DateJust
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
     * Add bids
     *
     * @param \Just2\BackendBundle\Entity\Bid $bids
     * @return DateJust
     */
    public function addBid(\Just2\BackendBundle\Entity\Bid $bids)
    {
        $this->bids[] = $bids;
    
        return $this;
    }

    /**
     * Remove bids
     *
     * @param \Just2\BackendBundle\Entity\Bid $bids
     */
    public function removeBid(\Just2\BackendBundle\Entity\Bid $bids)
    {
        $this->bids->removeElement($bids);
    }

    /**
     * Get bids
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBids()
    {
        return $this->bids;
    }
}