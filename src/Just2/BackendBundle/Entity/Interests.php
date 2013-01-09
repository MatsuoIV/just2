<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Table(name="interests")
 * @ORM\Entity()
 */
class Interests {

	/**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $datePreference
     *
     * @ORM\Column(name="datePreference", type="string", length=255)
     */
    
    private $interest;

    /**
     * @ORM\ManyToOne(targetEntity="Just2\BackendBundle\Entity\Member")
     */
    private $member;

    
    public function __toString()
    {
        return $this->getInterests();
    }

    
    /**
     * Set interests
     *
     * @param string $interests
     * @return Interests
     */
    public function setInterest($interest)
    {
        $this->interest = $interest;
    
        return $this;
    }

    /**
     * Get interests
     *
     * @return string 
     */
    public function getInterest()
    {
        return $this->interest;
    }

    /**
     * Set member
     *
     * @param \Just2\BackendBundle\Entity\Member $member
     * @return Interests
     */
    public function setMember(\Just2\BackendBundle\Entity\Member $member = null)
    {
        $this->member = $member;
    
        return $this;
    }

    /**
     * Get interests
     *
     * @return \Just2\BackendBundle\Entity\Member 
     */
    public function getMember()
    {
        return $this->member;
    }

}