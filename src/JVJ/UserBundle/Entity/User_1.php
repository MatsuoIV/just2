<?php 

//namespace JVJ\UserBundle\Entity;
//
//use Symfony\Component\Security\Core\User\AdvancedUserInterface;
//use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Validator\Constraints as Assert;
//use Doctrine\Common\Collections\ArrayCollection;
//
//
///**
// * JVJ\UserBundle\Entity\User
// *
// * @ORM\Table(name="jvj_user")
// * @ORM\Entity(repositoryClass="JVJ\UserBundle\Entity\UserRepository")
// */
//class User implements AdvancedUserInterface, \Serializable {
//
//    function isEqualTo(\Symfony\Component\Security\Core\User\UserInterface $user) {
//        return $this->getEmail() == $user->getEmail();
//    }
//    /**
//     * @ORM\Column(name="id", type="integer")
//     * @ORM\Id()
//     * @ORM\GeneratedValue(strategy="AUTO")
//     */
//    private $id;
//
//    /**
//     * @ORM\Column(name="username", type="string", length=25, unique=true)
//     */
//    private $username;
//
//    /**
//     * @ORM\Column(name="salt", type="string", length=40)
//     */
//    private $salt;
//
//    /**
//     * @ORM\Column(name="password", type="string", length=40)
//     */
//    private $password;
//
//    /**
//     * @ORM\Column(name="email", type="string", length=60, unique=true, nullable=true)
//     */
//    private $email;
//
//    /**
//     * @ORM\Column(type="string", length=40)
//     */
//    private $codeActivation;
//
//    /**
//     * @ORM\Column(name="is_active", type="boolean", nullable=true)
//     */
//    private $isActive;
//
//    /**
//     * @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
//     *
//     */
//    private $role;
//
//    /**
//     * @ORM\Column(type="string", length=200, nullable=true)
//     */
//    private $face;
//
//    public function uploadFace($directorioDestino) {
//        if (null === $this->face) {
//            return;
//        }
//
//        $nameUploadFace = uniqid('JVJUser-') . '.jpg';
//        $this->face->move($directorioDestino, $nameUploadFace);
//        $this->setFoto($nameUploadFace);
//    }
//
//    public function __toString() {
//        return $this->getUsername();
//    }
//
//    public function __construct() {
//        $this->role = new ArrayCollection();
//    }
//
//    
//    /**
//     * Método requerido por la interfaz UserInterface
//     */
//    public function getRoles() {
//        return array('ROLE_USUARIO');
//    }
//
//    public function eraseCredentials() {
//        
//    }
//
//    public function getUsername() {
//        return $this->username;
//    }
//
//    public function getSalt() {
//        return $this->salt;
//    }
//
//    public function getPassword() {
//        return $this->password;
//    }
//    
//    
//    public function serialize() {
//        return serialize($this->getId());
//    }
//
//    public function unserialize($data) {
//        $this->id = unserialize($data);
//    }
//
//    /**
//     * Get id
//     *
//     * @return integer 
//     */
//    public function getId() {
//        return $this->id;
//    }
//
//    /**
//     * Set username
//     *
//     * @param string $username
//     */
//    public function setUsername($username) {
//        $this->username = $username;
//    }
//
//    /**
//     * Set salt
//     *
//     * @param string $salt
//     */
//    public function setSalt($salt) {
//        $this->salt = $salt;
//    }
//
//    /**
//     * Set password
//     *
//     * @param string $password
//     */
//    public function setPassword($password) {
//        $this->password = $password;
//    }
//
//    /**
//     * Set email
//     *
//     * @param string $email
//     */
//    public function setEmail($email) {
//        $this->email = $email;
//    }
//
//    /**
//     * Get email
//     *
//     * @return string 
//     */
//    public function getEmail() {
//        return $this->email;
//    }
//
//    /**
//     * Set isActive
//     *
//     * @param boolean $isActive
//     */
//    public function setIsActive($isActive) {
//        $this->isActive = $isActive;
//    }
//
//    /**
//     * Get isActive
//     *
//     * @return boolean 
//     */
//    public function getIsActive() {
//        return $this->isActive;
//    }
//
//    public function isAccountNonExpired() {
//        return true;
//    }
//
//    public function isAccountNonLocked() {
//        return true;
//    }
//
//    public function isCredentialsNonExpired() {
//        return true;
//    }
//
//    public function isEnabled() {
//        return $this->isActive;
//    }
//
//    /**
//     * Add role
//     *
//     * @param JVJ\UserBundle\Entity\Role $role
//     */
//    public function addRole(\JVJ\UserBundle\Entity\Role $role) {
//        $this->role[] = $role;
//    }
//
//    /**
//     * Get role
//     *
//     * @return Doctrine\Common\Collections\Collection 
//     */
//    public function getRole() {
//        return $this->role;
//    }
//
//    public function generateCodeActivation($length = 10, $uc = TRUE, $n = TRUE, $sc = FALSE) {
//        $source = 'abcdefghijklmnopqrstuvwxyz';
//        if ($uc == 1)
//            $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
//        if ($n == 1)
//            $source .= '1234567890';
//        if ($sc == 1)
//            $source .= '|@#~$%()=^*+[]{}-_';
//        if ($length > 0) {
//            $rstr = "";
//            $source = str_split($source, 1);
//            for ($i = 1; $i <= $length; $i++) {
//                mt_srand((double) microtime() * 1000000);
//                $num = mt_rand(1, count($source));
//                $rstr .= $source[$num - 1];
//            }
//        }
//        return $rstr;
//    }
//
//
//
//    /**
//     * Set codeActivation
//     *
//     * @param string $codeActivation
//     * @return User
//     */
//    public function setCodeActivation($codeActivation)
//    {
//        $this->codeActivation = $codeActivation;
//    
//        return $this;
//    }
//
//    /**
//     * Get codeActivation
//     *
//     * @return string 
//     */
//    public function getCodeActivation()
//    {
//        return $this->codeActivation;
//    }
//
//    /**
//     * Set face
//     *
//     * @param string $face
//     * @return User
//     */
//    public function setFace($face)
//    {
//        $this->face = $face;
//    
//        return $this;
//    }
//
//    /**
//     * Get face
//     *
//     * @return string 
//     */
//    public function getFace()
//    {
//        return $this->face;
//    }
//
//  
//
//    /**
//     * Remove role
//     *
//     * @param \JVJ\UserBundle\Entity\Role $role
//     */
//    public function removeRole(\JVJ\UserBundle\Entity\Role $role)
//    {
//        $this->role->removeElement($role);
//    }
//
//
//}