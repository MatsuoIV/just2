<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use JVJ\UserBundle\Entity\User;

/**
 * @ORM\Table(name="member")
 * @ORM\Entity()
 */
class Member {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="DateJust", mappedBy="member")
     */
    protected $dateJusts;

    /**
     * @ORM\OneToMany(targetEntity="Bid", mappedBy="member")
     */
    protected $bids;

    /** @ORM\Column(type="string", length=255) */
    private $firstName;

    /** @ORM\Column(type="string", length=255) */
    private $lastName;

    /** @ORM\Column(type="string", length=255) */
    private $street;

    /**
     * @ORM\ManyToOne(targetEntity="JVJ\UtilBundle\Entity\Department")
     */
    private $state;

    /** @ORM\Column(type="string", length=255) */
    private $postCode;

    /**
     * @ORM\ManyToOne(targetEntity="JVJ\UtilBundle\Entity\Country")
     */
    private $country;

    /** @ORM\Column(type="string", length=255) */
    private $phone;

    /** @ORM\Column(type="string", length=255) */
    private $mobile;

    /** @ORM\Column(type="datetime") 
     * 
     * @Assert\DateTime
     */
    private $dateOfBirth;

    /** @ORM\Column(type="string", length=255) */
    private $gender;

    /**
     * @ORM\OneToOne(targetEntity="\JVJ\UserBundle\Entity\User", mappedBy="member")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
   /** @ORM\Column(type="integer") */
    private $height;

    /** @ORM\Column(type="string", length=255) */
    private $eyeColour;

    /** @ORM\Column(type="string", length=255) */
    private $hairColour;

    /**
     * @var string $datePreference
     *
     * @ORM\Column(name="datePreference", type="string", length=255)
     */
    private $datePreference;

    /**
     * @var string $smoker
     *
     * @ORM\Column(name="smoker", type="string", length=255)
     */
    private $smoker;

    /**
     * @var string $children
     *
     * @ORM\Column(name="children", type="string", length=255)
     */
    private $children;

    /**
     * @var string $relationship
     *
     * @ORM\Column(name="relationship", type="string", length=255)
     */
    private $relationship;

    /**
     * @var string $profession
     *
     * @ORM\Column(name="profession", type="string", length=255)
     */
    private $profession;

    /**
     * @var string $personality
     *
     * @ORM\Column(name="personality", type="text")
     */
    private $personality;

    /**
     * @ORM\ManyToMany(targetEntity="Just2\BackendBundle\Entity\Interest")
     */
    private $interest;
    
    public function __toString() {
        return $this->getFirstName();
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dateJusts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bids = new \Doctrine\Common\Collections\ArrayCollection();
        $this->interest = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set firstName
     *
     * @param string $firstName
     * @return Member
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Member
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Member
     */
    public function setStreet($street)
    {
        $this->street = $street;
    
        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set postCode
     *
     * @param string $postCode
     * @return Member
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;
    
        return $this;
    }

    /**
     * Get postCode
     *
     * @return string 
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Member
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
     * Set mobile
     *
     * @param string $mobile
     * @return Member
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    
        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     * @return Member
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    
        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime 
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Member
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    
        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return Member
     */
    public function setHeight($height)
    {
        $this->height = $height;
    
        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set eyeColour
     *
     * @param string $eyeColour
     * @return Member
     */
    public function setEyeColour($eyeColour)
    {
        $this->eyeColour = $eyeColour;
    
        return $this;
    }

    /**
     * Get eyeColour
     *
     * @return string 
     */
    public function getEyeColour()
    {
        return $this->eyeColour;
    }

    /**
     * Set hairColour
     *
     * @param string $hairColour
     * @return Member
     */
    public function setHairColour($hairColour)
    {
        $this->hairColour = $hairColour;
    
        return $this;
    }

    /**
     * Get hairColour
     *
     * @return string 
     */
    public function getHairColour()
    {
        return $this->hairColour;
    }

    /**
     * Set datePreference
     *
     * @param string $datePreference
     * @return Member
     */
    public function setDatePreference($datePreference)
    {
        $this->datePreference = $datePreference;
    
        return $this;
    }

    /**
     * Get datePreference
     *
     * @return string 
     */
    public function getDatePreference()
    {
        return $this->datePreference;
    }

    /**
     * Set smoker
     *
     * @param string $smoker
     * @return Member
     */
    public function setSmoker($smoker)
    {
        $this->smoker = $smoker;
    
        return $this;
    }

    /**
     * Get smoker
     *
     * @return string 
     */
    public function getSmoker()
    {
        return $this->smoker;
    }

    /**
     * Set children
     *
     * @param string $children
     * @return Member
     */
    public function setChildren($children)
    {
        $this->children = $children;
    
        return $this;
    }

    /**
     * Get children
     *
     * @return string 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set relationship
     *
     * @param string $relationship
     * @return Member
     */
    public function setRelationship($relationship)
    {
        $this->relationship = $relationship;
    
        return $this;
    }

    /**
     * Get relationship
     *
     * @return string 
     */
    public function getRelationship()
    {
        return $this->relationship;
    }

    /**
     * Set profession
     *
     * @param string $profession
     * @return Member
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;
    
        return $this;
    }

    /**
     * Get profession
     *
     * @return string 
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Set personality
     *
     * @param string $personality
     * @return Member
     */
    public function setPersonality($personality)
    {
        $this->personality = $personality;
    
        return $this;
    }

    /**
     * Get personality
     *
     * @return string 
     */
    public function getPersonality()
    {
        return $this->personality;
    }

    /**
     * Add dateJusts
     *
     * @param \Just2\BackendBundle\Entity\DateJust $dateJusts
     * @return Member
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
     * Add bids
     *
     * @param \Just2\BackendBundle\Entity\Bid $bids
     * @return Member
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

    /**
     * Set state
     *
     * @param \JVJ\UtilBundle\Entity\Department $state
     * @return Member
     */
    public function setState(\JVJ\UtilBundle\Entity\Department $state = null)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return \JVJ\UtilBundle\Entity\Department 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set country
     *
     * @param \JVJ\UtilBundle\Entity\Country $country
     * @return Member
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
     * Set user
     *
     * @param \JVJ\UserBundle\Entity\User $user
     * @return Member
     */
    public function setUser(\JVJ\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \JVJ\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add interest
     *
     * @param \Just2\BackendBundle\Entity\Interest $interest
     * @return Member
     */
    public function addInterest(\Just2\BackendBundle\Entity\Interest $interest)
    {
        $this->interest[] = $interest;
    
        return $this;
    }

    /**
     * Remove interest
     *
     * @param \Just2\BackendBundle\Entity\Interest $interest
     */
    public function removeInterest(\Just2\BackendBundle\Entity\Interest $interest)
    {
        $this->interest->removeElement($interest);
    }

    /**
     * Get interest
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInterest()
    {
        return $this->interest;
    }
}