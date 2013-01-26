<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="messsage")
 * @ORM\Entity()
 * 
 * @ORM\Entity(repositoryClass="Just2\BackendBundle\Entity\MessageRepository")
 */
class Message {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Member")
     */
    private $memberOf;

    /**
     * @ORM\ManyToOne(targetEntity="Member")
     */
    private $memberFor;

    /** @ORM\Column(type="string", length=255) */
    private $subject;

    /**
     * @ORM\Column(type="text")
     */
    private $bodyMessage;

    /**
     * @ORM\Column(name="imessage", type="smallint", nullable=false)
     */
    private $imessage;

    /**
     * @ORM\ManyToOne(targetEntity="DateJust")
     */
    private $dateJust;

    /**
     * @ORM\Column(name="estate", type="smallint", nullable=false)
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
    public function getId() {
        return $this->id;
    }

    /**
     * Set bodyMessage
     *
     * @param string $bodyMessage
     * @return Message
     */
    public function setBodyMessage($bodyMessage) {
        $this->bodyMessage = $bodyMessage;

        return $this;
    }

    /**
     * Get bodyMessage
     *
     * @return string 
     */
    public function getBodyMessage($length = null) {

        if (false === is_null($length) && $length > 0)
            return substr($this->bodyMessage, 0, $length) . "...";
        else
            return $this->bodyMessage;
    }

    /**
     * Set estate
     *
     * @param integer $estate
     * @return Message
     */
    public function setEstate($estate) {
        $this->estate = $estate;

        return $this;
    }

    /**
     * Get estate
     *
     * @return integer 
     */
    public function getEstate() {
        return $this->estate;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Message
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set memberOf
     *
     * @param \Just2\BackendBundle\Entity\Member $memberOf
     * @return Message
     */
    public function setMemberOf(\Just2\BackendBundle\Entity\Member $memberOf = null) {
        $this->memberOf = $memberOf;

        return $this;
    }

    /**
     * Get memberOf
     *
     * @return \Just2\BackendBundle\Entity\Member 
     */
    public function getMemberOf() {
        return $this->memberOf;
    }

    /**
     * Set memberFor
     *
     * @param \Just2\BackendBundle\Entity\Member $memberFor
     * @return Message
     */
    public function setMemberFor(\Just2\BackendBundle\Entity\Member $memberFor = null) {
        $this->memberFor = $memberFor;

        return $this;
    }

    /**
     * Get memberFor
     *
     * @return \Just2\BackendBundle\Entity\Member 
     */
    public function getMemberFor() {
        return $this->memberFor;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return Message
     */
    public function setSubject($subject) {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject($length = null) {
        if (false === is_null($length) && $length > 0)
            return substr($this->subject, 0, $length) . "...";
        else
            return $this->subject;
    }

    /**
     * Set dateJust
     *
     * @param \Just2\BackendBundle\Entity\DateJust $dateJust
     * @return Message
     */
    public function setDateJust(\Just2\BackendBundle\Entity\DateJust $dateJust = null) {
        $this->dateJust = $dateJust;

        return $this;
    }

    /**
     * Get dateJust
     *
     * @return \Just2\BackendBundle\Entity\DateJust 
     */
    public function getDateJust() {
        return $this->dateJust;
    }

    /**
     * Set imessage
     *
     * @param integer $imessage
     * @return Message
     */
    public function setImessage($imessage) {
        $this->imessage = $imessage;

        return $this;
    }

    /**
     * Get imessage
     *
     * @return integer 
     */
    public function getImessage() {
        return $this->imessage;
    }

}