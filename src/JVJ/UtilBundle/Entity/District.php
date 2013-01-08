<?php

namespace JVJ\UtilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="jvj_district")
 * @ORM\Entity()
 */
class District {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="JVJ\UtilBundle\Entity\Department")
     */
    private $Department;

    public function __toString() {
        return $this->getName();
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
     * Set name
     *
     * @param string $name
     * @return District
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Department
     *
     * @param \JVJ\UtilBundle\Entity\Department $department
     * @return District
     */
    public function setDepartment(\JVJ\UtilBundle\Entity\Department $department = null)
    {
        $this->Department = $department;
    
        return $this;
    }

    /**
     * Get Department
     *
     * @return \JVJ\UtilBundle\Entity\Department 
     */
    public function getDepartment()
    {
        return $this->Department;
    }
}