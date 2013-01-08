<?php
namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="bid")
 * @ORM\Entity()
 */
Class Bid
{
     /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
    * @ORM\Column(name="price", type="decimal", scale=2, nullable=false)
    * 
    * @Assert\Regex(pattern="/^[0-9]+(\.\d{1,2})?$/",message="incorrectly entered price.")
    * @Assert\Type(type="float")
    * @Assert\Range(min = 0)
    */
    private $price;
    
    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="bids")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */
    private $member;
    
    /**
     * @ORM\ManyToOne(targetEntity="DateJust", inversedBy="bids")
     */
    private $dateJust;

    /**
     * @ Var smallint $estado
     *
     * @ ORM \ Column (name = "estate", type = "smallint", nullable = false)
     */
    
    private $estate;
    /**
     *  @var datetime $createdAt
     *
     * @ORM\Column(name="createdAt", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;


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
     * Set price
     *
     * @param float $price
     * @return Bid
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Bid
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
     * Set member
     *
     * @param \Just2\BackendBundle\Entity\Member $member
     * @return Bid
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
     * Set date
     *
     * @param \Just2\BackendBundle\Entity\DateJust $date
     * @return Bid
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
     * @return Bid
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