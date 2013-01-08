<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
    private $email;    

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
    private $phoneCode;

    /** @ORM\Column(type="string", length=255) */
    private $phone;

    /** @ORM\Column(type="string", length=255) */
    private $mobile;

    private $password;

    /** @ORM\Column(type="datetime") 
     * 
     * @Assert\DateTime
     */
    private $dateOfBirth;

    /** @ORM\Column(type="string", length=255) */
    private $gender;

    /**
     * @Assert\Type(type="JVJ\UserBundle\Entity\User")
     */
    private $user;

    private $userId;


    public function __toString()
    {
        return $this->getFirstName();
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->dates = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bids = new \Doctrine\Common\Collections\ArrayCollection();
        $this->auctions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get dates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDates() {
        return $this->dates;
    }

    /**
     * Add bids
     *
     * @param \Just2\BackendBundle\Entity\Bid $bids
     * @return Member
     */
    public function addBid(\Just2\BackendBundle\Entity\Bid $bids) {
        $this->bids[] = $bids;

        return $this;
    }

    /**
     * Remove bids
     *
     * @param \Just2\BackendBundle\Entity\Bid $bids
     */
    public function removeBid(\Just2\BackendBundle\Entity\Bid $bids) {
        $this->bids->removeElement($bids);
    }

    /**
     * Get bids
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBids() {
        return $this->bids;
    }

    /**
     * Add auctions
     *
     * @param \Just2\BackendBundle\Entity\auction $auctions
     * @return Member
     */
    public function addAuction(\Just2\BackendBundle\Entity\auction $auctions) {
        $this->auctions[] = $auctions;

        return $this;
    }

    /**
     * Remove auctions
     *
     * @param \Just2\BackendBundle\Entity\auction $auctions
     */
    public function removeAuction(\Just2\BackendBundle\Entity\auction $auctions) {
        $this->auctions->removeElement($auctions);
    }

    /**
     * Get auctions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAuctions() {
        return $this->auctions;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Member
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Member
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Member 
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return email 
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Member
     */
    public function setStreet($street) {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet() {
        return $this->street;
    }

    /**
     * Set postCode
     *
     * @param string $postCode
     * @return Member
     */
    public function setPostCode($postCode) {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get postCode
     *
     * @return string 
     */
    public function getPostCode() {
        return $this->postCode;
    }

    /**
     * Set phoneCode
     *
     * @param string $phoneCode
     * @return Member
     */
    public function setPhoneCode($phoneCode) {
        $this->phoneCode = $phoneCode;

        return $this;
    }

    /**
     * Get phoneCode
     *
     * @return string 
     */
    public function getPhoneCode() {
        return $this->phoneCode;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Member
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Member
     */
    public function setMobile($mobile) {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile() {
        return $this->mobile;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Member
     */
    public function setGender($gender) {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender() {
        return $this->gender;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Member
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set state
     *
     * @param \JVJ\UtilBundle\Entity\Department $state
     * @return Member
     */
    public function setState(\JVJ\UtilBundle\Entity\Department $state = null) {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \JVJ\UtilBundle\Entity\Department 
     */
    public function getState() {
        return $this->state;
    }

    /**
     * Set country
     *
     * @param \JVJ\UtilBundle\Entity\Country $country
     * @return Member
     */
    public function setCountry(\JVJ\UtilBundle\Entity\Country $country = null) {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \JVJ\UtilBundle\Entity\Country 
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     * @return Member
     */
    public function setDateOfBirth($dateOfBirth) {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime 
     */
    public function getDateOfBirth() {
        return $this->dateOfBirth;
    }

    /**
     * Add dateJusts
     *
     * @param \Just2\BackendBundle\Entity\DateJust $dateJusts
     * @return Member
     */
    public function addDateJust(\Just2\BackendBundle\Entity\DateJust $dateJusts) {
        $this->dateJusts[] = $dateJusts;

        return $this;
    }

    /**
     * Remove dateJusts
     *
     * @param \Just2\BackendBundle\Entity\DateJust $dateJusts
     */
    public function removeDateJust(\Just2\BackendBundle\Entity\DateJust $dateJusts) {
        $this->dateJusts->removeElement($dateJusts);
    }

    /**
     * Get dateJusts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDateJusts() {
        return $this->dateJusts;
    }

    /**
    * Set user
    *
    * @param string $userId
    * @return Member
    */
    public function setUserId($userId) {
        $this->userId = $userId;
    }

    /**
    * Get user
    *
    * 
    * @return string
    */
    public function getUserId() {
        return $this->userId;
    }
    
    //Por definir variable $user

    /**
     * Set user
     *
     * @param string $user
     * @return Member
     */
    public function setUser(User $user) {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser() {
        return $this->user;
    }

}