<?php

namespace Alloservice\SiteBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contact
 */
class Contact
{
    /**
     * @var string
     * @Assert\Email(message="Votre adresse e-mail n'est pas valide!")
     */
    private $email;

    /**
     * @var string
     * @Assert\Length(min=10, minMessage="Votre description doit contenir au moins 10 caractères!")
     */
    private $description;

    /**
     * @var string
     */
    private $categories;
   
    public function __construct()
    {
        $this->email = strtolower($this->email);
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Contact
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
     * Set description
     *
     * @param string $description
     *
     * @return Contact
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set categories
     *
     * @param string $categories
     *
     * @return Contact
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories
     *
     * @return string
     */
    public function getCategories()
    {
        return $this->categories;
    }

}
