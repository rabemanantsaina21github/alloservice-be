<?php

namespace Alloservice\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Alloservice\UserBundle\Repository\UserRepository")
 * @UniqueEntity(fields="username", message="Ce pseudo est déjà pris!")
 * @UniqueEntity(fields="email", message="Cette adresse e-mail est déjà utilisée à un autre compte!")
 * 
 */
class User implements UserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=60)
     * @Assert\Length(min=3, minMessage="Votre prénom est trop court!")
     * @Assert\Regex(pattern = "/^[a-z \.\-'àâäéêëèîïôöùûüç]+$/i", message = "Votre prénom n'est pas correct!")
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60)
     * @Assert\Length(min=3, minMessage="Votre nom est trop court!")
     * @Assert\Regex(pattern = "/^[a-z \.\-'àâäéêëèîïôöùûüç]+$/i", message = "Votre nom n'est pas correct!")
     */
    private $name;

    /**
     * @var string
     * @Gedmo\Slug(fields={"name","lastname"})
     * @ORM\Column(name="username", type="string", length=20, unique=true)
     * @Assert\Length(min=3, minMessage="Votre pseudo est trop court !")
     * @Assert\Regex(pattern = "/^[a-zA-Z0-9]+$/i", message = "Votre pseudo n'est pas correct!")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     * @Assert\Email(message = "Votre adresse email n'est pas correct!")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=8, nullable=true)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Assert\Length(min=8, minMessage="Un mot de passe doit contenir au moins 8 caractères!")
     */
    private $password;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=15, nullable=true)
     */
    private $token;

    /**
     * @var bool
     *
     * @ORM\Column(name="actived", type="boolean")
     */
    private $actived;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tokenExpiredDate", type="datetime", nullable=true)
     */
    private $tokenExpiredDate;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = ['ROLE_CLIENT'];

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registrationDate", type="datetime", nullable=true)
     */
    private $registrationDate;

    /**
     * @ORM\ManyToOne(targetEntity="Alloservice\SiteBundle\Entity\City")
     * @ORM\JoinColumn(nullable=true)
     */
    private $city;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function StrToken($length)
    {
      $alpha = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN-_";
      return substr(str_shuffle(str_repeat($alpha, $length)), 0, $length);
    }
    
    public function preUpdate()
    {
        $this->name = ucwords(strtolower($this->name));
        $this->lastname = ucwords(strtolower($this->lastname));
        $this->email = strtolower($this->email);
    }
    
    /** 
     * Permet de recharger l'utilisateur à partir de la session
     * 
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
        $this->id,
        $this->email,
        $this->username,
        $this->password,
        $this->salt
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->username,
            $this->password,
            $this->salt,
        ) = unserialize($serialized);
    }
    
    public function eraseCredentials()
    {
        
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set genre
     *
     * @param string $genre
     *
     * @return User
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set plainPassword
     *
     * @param string $plainPassword
     *
     * @return User
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Get plainPassword
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return User
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set actived
     *
     * @param boolean $actived
     *
     * @return User
     */
    public function setActived($actived)
    {
        $this->actived = $actived;

        return $this;
    }

    /**
     * Get actived
     *
     * @return bool
     */
    public function getActived()
    {
        return $this->actived;
    }

    /**
     * Set tokenExpiredDate
     *
     * @param \DateTime $tokenExpiredDate
     *
     * @return User
     */
    public function setTokenExpiredDate($tokenExpiredDate)
    {
        $this->tokenExpiredDate = $tokenExpiredDate;

        return $this;
    }

    /**
     * Get tokenExpiredDate
     *
     * @return \DateTime
     */
    public function getTokenExpiredDate()
    {
        return $this->tokenExpiredDate;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt()
    {
        $this->salt = sha1(uniqid(mt_rand()));

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set registrationDate
     *
     * @param \DateTime $registrationDate
     *
     * @return User
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * Get registrationDate
     *
     * @return \DateTime
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     * Set city
     *
     * @param \Alloservice\SiteBundle\Entity\City $city
     *
     * @return User
     */
    public function setCity(\Alloservice\SiteBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Alloservice\SiteBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }
}
