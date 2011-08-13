<?php

namespace Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
* @ORM\Table(name="user") 
* @ORM\Entity
*/
class User implements UserInterface
{
    
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

     /**
     * @ORM\Column(name="firstname", type="string", length=255, nullable=false)
     */
    private $firstname;
    
    /**
     * @ORM\Column(name="lastname", type="string", length=255, nullable=false)
     */
    private $lastname;
    
    /**
     * @ORM\Column(name="email", type="string", length=256, nullable=false)
     */
    private $email;
    
    /**
     * @ORM\Column(name="username", type="string", length=256, nullable=false)
     */
    private $username;

    /**
     * @ORM\Column(name="password", type="string", length=256, nullable=true)
     */
    private $password;
    
    /**
     * @assert:Required
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="string", length="255", nullable="false")
     */
    protected $salt;
    
    /**
     * @ORM\Column(name="created", type="datetime", nullable="false")
     */
    protected $created;
    
    
    public function __construct()
    {
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->created = new \DateTime();
    }
    
    /*** GETTERS ***/
    
    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        
        return $this->id;
    }
    
    /**
     * Get firstname
     * @return string
     */
    function getFirstname()
    {
        
        return $this->firstname;
    }
    
    /**
     * Get lastname
     * @return string
     */
    function getLastname()
    {
        
        return $this->lastname;
    }
    
    /**
     * Get email
     * @return string 
     */
    function getEmail()
    {
        
        return $this->email;
    }
    
    /**
     * Get username
     * @return string 
     */
    function getUsername()
    {
        
        return $this->username;
    }
    
    /**
     * Get password
     * @return string 
     */
    function getPassword()
    {
        
        return $this->password;
    }
    
    /**
     * Gets the plain text password entered on forms
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
    
    /**
     * Returns the salt.
     * @return string
     */
    public function getSalt()
    {
        
        return $this->salt;    
    }
    
    /**
     * Gets the creation time of the notification
     * @return DateTime
     */
    public function getCreated()
    {
        
        return $this->created;
    }
    
    /**
     * Returns the roles granted to the user.
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        $roles = array('ROLE_ADMIN');
        
        return $roles;               
    }
    
    /*** SETTERS ***/

    /**
     * Set firstname
     * @param type $firstname
     */
    public function setFirstname($firstname)
    {
       
        $this->firstname = $firstname;
    }
    
    /**
     * Set lastname
     * @param type $lastname
     */
    public function setLastname($lastname)
    {
       
        $this->lastname = $lastname;
    }
    
    /**
     * Set email
     * @param type $email
     */
    public function setEmail($email)
    {
       
        $this->email = $email;
    }

    /**
     * Set username
     * @param type $username 
     */
    public function setUsername($username)
    {
       
        $this->username = $username;
    }
    
    /**
     * Set password
     * @param type $password 
     */
    public function setPassword($password)
    {
       
        $this->password = $password;
    }

    /**
     * Set the plain text password for the user
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }
    
    /**
     * Removes sensitive data from the user.
     * @return void
     */
    function eraseCredentials()
    {
        // Just to get you up and running, for now do nothing here.
        // you'll want to delete this stuff when you actually want to log your user out... =)
    }

    /**
     * @param UserInterface $user
     * @return Boolean
     */
    function equals(UserInterface $user)
    {
        if (!$user instanceof User) {
            return false;
        }
        
        if ($this->email !== $user->getEmail()) {
            return false;
        }

        if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->getSalt() !== $user->getSalt()) {
            return false;
        }

        return true;
    }

}