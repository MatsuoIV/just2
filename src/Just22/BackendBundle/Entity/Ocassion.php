<?php

namespace Just2\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="ocassion")
 * @ORM\Entity()
 */
class Ocassion {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** @ORM\Column(type="string", length=255) */
    private $name;

    /**
     * @ORM\Column(name="price", type="decimal", scale=2, nullable=false)
     * 
     * @Assert\Regex(pattern="/^[0-9]+(\.\d{1,2})?$/",message="incorrectly entered price.")
     * @Assert\Type(type="float")
     * @Assert\Range(min = 0)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="CategoryOcassion")
     */
    private $categoryOcassion;

    /**
     * @ORM\OneToMany(targetEntity="DateJust", mappedBy="ocassion")
     */
    protected $dateJusts;

    /**
     * Constructor
     */
    public function __construct() {
        $this->dates = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Ocassion
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Ocassion
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice() {
        return $this->price;
    }





    /**
     * Set categoryOcassion
     *
     * @param \Just2\BackendBundle\Entity\CategoryOcassion $categoryOcassion
     * @return Ocassion
     */
    public function setCategoryOcassion(\Just2\BackendBundle\Entity\CategoryOcassion $categoryOcassion = null)
    {
        $this->categoryOcassion = $categoryOcassion;
    
        return $this;
    }

    /**
     * Get categoryOcassion
     *
     * @return \Just2\BackendBundle\Entity\CategoryOcassion 
     */
    public function getCategoryOcassion()
    {
        return $this->categoryOcassion;
    }


    /**
     * Add dateJusts
     *
     * @param \Just2\BackendBundle\Entity\DateJust $dateJusts
     * @return Ocassion
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
}