<?php

namespace JVJ\UserBundle\Entity;

//
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * JVJ\UserBundle\Entity\User 
 * @ORM\Entity()
 *
 * @UniqueEntity(fields="email", message="Sorry, this email address is already in use.", groups={"registration"})
 * @UniqueEntity(fields="username", message="Sorry, this username is already taken.", groups={"registration"})
 * @ORM\Table(name="jvj_user")
 * @ORM\Entity(repositoryClass="JVJ\UserBundle\Entity\UserRepository")
 */
class User implements AdvancedUserInterface, \Serializable {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="username", type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(name="salt", type="string", length=40)
     */
    private $salt;

    /**
     * @ORM\Column(name="password", type="string", length=40)
     * @Assert\Length(min = 8)
     */
    private $password;

    /**
     * @ORM\Column(name="email", type="string", length=60, unique=true, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $codeActivation;

    /**
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $face;

    /**
     * @ORM\ManyToMany(targetEntity="Group", inversedBy="users")
     *
     */
    private $groups;

    /**
     * @ORM\OneToOne(targetEntity="\Just2\BackendBundle\Entity\Member", mappedBy="user")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */
    private $member;

    /**
     * @Assert\NotBlank()
     * @Assert\True()
     */
    protected $termsAccepted;

    public function uploadFace($directorioDestino) {
        if (null === $this->face) {
            return;
        }

        $nameUploadFace = uniqid('JVJUser-') . '.jpg';
        $this->face->move($directorioDestino, $nameUploadFace);
        $this->setFoto($nameUploadFace);
    }

    public function __toString() {
        return $this->getUsername();
    }

    public function __construct() {
        $this->groups = new ArrayCollection();
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
    }

    /**
     * Método requerido por la interfaz UserInterface
     */
    public function getRoles() {
        return $this->groups->toArray();
    }

    public function eraseCredentials() {
        
    }

    public function getUsername() {
        return $this->username;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getPassword() {
        return $this->password;
    }

    public function isAccountNonExpired() {
        return true;
    }

    public function isAccountNonLocked() {
        return true;
    }

    public function isCredentialsNonExpired() {
        return true;
    }

    public function isEnabled() {
        return $this->isActive;
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
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt) {
        $this->salt = $salt;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail() {
        return $this->email;
    }

    public function generateCodeActivation($length = 10, $uc = TRUE, $n = TRUE, $sc = FALSE) {
        $source = 'abcdefghijklmnopqrstuvwxyz';
        if ($uc == 1)
            $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if ($n == 1)
            $source .= '1234567890';
        if ($sc == 1)
            $source .= '|@#~$%()=^*+[]{}-_';
        if ($length > 0) {
            $rstr = "";
            $source = str_split($source, 1);
            for ($i = 1; $i <= $length; $i++) {
                mt_srand((double) microtime() * 1000000);
                $num = mt_rand(1, count($source));
                $rstr .= $source[$num - 1];
            }
        }
        return $rstr;
    }

    /**
     * Set codeActivation
     *
     * @param string $codeActivation
     * @return User
     */
    public function setCodeActivation($codeActivation) {
        $this->codeActivation = $codeActivation;

        return $this;
    }

    /**
     * Get codeActivation
     *
     * @return string 
     */
    public function getCodeActivation() {
        return $this->codeActivation;
    }

    /**
     * Set face
     *
     * @param string $face
     * @return User
     */
    public function setFace($face) {
        $this->face = $face;

        return $this;
    }

    /**
     * Get face
     *
     * @return string 
     */
    public function getFace() {
        return $this->face;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive() {
        return $this->isActive;
    }

    /**
     * Add groups
     *
     * @param \JVJ\UserBundle\Entity\Group $groups
     * @return User
     */
    public function addGroup(\JVJ\UserBundle\Entity\Group $groups) {
        $this->groups[] = $groups;

        return $this;
    }

    /**
     * Remove groups
     *
     * @param \JVJ\UserBundle\Entity\Group $groups
     */
    public function removeGroup(\JVJ\UserBundle\Entity\Group $groups) {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups() {
        return $this->groups;
    }

    public function isRole() {
        
    }

    public function getTermsAccepted() {
        return $this->termsAccepted;
    }

    public function setTermsAccepted($termsAccepted) {
        $this->termsAccepted = (Boolean) $termsAccepted;
    }

    /**
     * Set member
     *
     * @param \Just2\BackendBundle\Entity\Member $member
     * @return User
     */
    public function setMember(\Just2\BackendBundle\Entity\Member $member = null) {
        $this->member = $member;

        return $this;
    }

    /**
     * Get member
     *
     * @return \Just2\BackendBundle\Entity\Member 
     */
    public function getMember() {
        return $this->member;
    }

    /**
     * Serializes the content of the current User object
     * @return string
     */
    public function serialize()
    {
        return \json_encode(
                array($this->getUsername(), $this->getPassword(), $this->getSalt(),
                $this->getRoles(), $this->getMember(), $this->getId()));
    }

    /**
     * Unserializes the given string in the current User object
     * @param serialized
     */
    public function unserialize($serialized)
    {
        list($this->username, $this->password, $this->salt,
                        $this->roles, $this->id) = \json_decode(
                $serialized);
    }

}