<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use JVJ\UserBundle\Entity\User;

/**
 * @ORM\Table(name="member")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
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

    /**
     * @ORM\OneToOne(targetEntity="\JVJ\UserBundle\Entity\User", mappedBy="member")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
    * @ORM\Column(name="image", type="string", length=255)
    */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $path;

    /**
    * @Assert\File(maxSize="6000000")
    */
    private $file;

    public function __toString() {
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
     * @param \Just2\BackendBundle\Entity\Auction $auctions
     * @return Member
     */
    public function addAuction(\Just2\BackendBundle\Entity\Auction $auctions) {
        $this->auctions[] = $auctions;

        return $this;
    }

    /**
     * Remove auctions
     *
     * @param \Just2\BackendBundle\Entity\auction $auctions
     */
    public function removeAuction(\Just2\BackendBundle\Entity\Auction $auctions) {
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
     * Set height
     *
     * @param integer $height
     * @return Member
     */
    public function setHeight($height) {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * Set eyeColour
     *
     * @param string $eyeColour
     * @return Member
     */
    public function setEyeColour($eyeColour) {
        $this->eyeColour = $eyeColour;

        return $this;
    }

    /**
     * Get eyeColour
     *
     * @return string 
     */
    public function getEyeColour() {
        return $this->eyeColour;
    }

    /**
     * Set hairColour
     *
     * @param string $hairColour
     * @return Member
     */
    public function setHairColour($hairColour) {
        $this->hairColour = $hairColour;

        return $this;
    }

    /**
     * Get hairColour
     *
     * @return string 
     */
    public function getHairColour() {
        return $this->hairColour;
    }

    /**
     * Set datePreference
     *
     * @param string $datePreference
     * @return Attributes
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
     * @return Attributes
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
     * @return Attributes
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
     * @return Attributes
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
     * @return Attributes
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
     * @return Attributes
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
     * Set interest
     *
     * @param \Just2\BackendBundle\Entity\Interest $interest
     * @return Member
     */
    public function setInterest(\Just2\BackendBundle\Entity\Interest $interest = null) {
        $this->interest = $interest;

        return $this;
    }

    /**
     * Get interest
     *
     * @return \Just2\BackendBundle\Entity\Interest 
     */
    public function getInterest() {
        return $this->interest;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Member
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
     * file
     */
    // public function getAbsolutePath()
    // {
    //     return null === $this->path
    //         ? null
    //         : $this->getUploadRootDir().'/'.$this->id.'.'.$this->path;
    // }


    // public function getWebPath()
    // {
    //     return null === $this->path
    //         ? null
    //         : $this->getUploadDir().'/'.$this->path;
    // }

    // protected function getUploadRootDir()
    // {
    //     // the absolute directory path where uploaded
    //     // documents should be saved
    //     return __DIR__.'/../../../../web/'.$this->getUploadDir();
    // }

    // protected function getUploadDir()
    // {
    //     // get rid of the __DIR__ so it doesn't screw up
    //     // when displaying uploaded doc/image in the view.
    //     return 'uploads/documents';
    // }

    public function getPath()
    {
        return $this->path;
    }
 
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }
 
    public function setFile($file)
    {
        $this->file = $file;
    }

    // a property used temporarily while deleting
    private $filenameForRemove;

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // do whatever you want to generate a unique name
            $filename = $this->id;
            $this->path = $filename.'.'.$this->file->guessExtension();
            // $this->path = $filename.'.png';
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->file->move('images_user', $this->path);

        unset($this->file);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
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
}