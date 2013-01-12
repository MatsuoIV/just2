<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Table(name="member_interest")
 * @ORM\Entity()
 */
class MemberInterest {

	/**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Just2\BackendBundle\Entity\Interest")
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
     * Set interest
     *
     * @param \Just2\BackendBundle\Entity\Interest $interest
     * @return MemberInterest
     */
    public function setInterest(\Just2\BackendBundle\Entity\Interest $interest = null)
    {
        $this->interest = $interest;
    
        return $this;
    }

    /**
     * Get interest
     *
     * @return \Just2\BackendBundle\Entity\Interest 
     */
    public function getInterest()
    {
        return $this->interest;
    }

    /**
     * Set member
     *
     * @param \Just2\BackendBundle\Entity\Member $member
     * @return MemberInterest
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

}