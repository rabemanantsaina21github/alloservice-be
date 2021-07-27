<?php

namespace Alloservice\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="demande")
 * @ORM\Entity(repositoryClass="Alloservice\SiteBundle\Repository\DemandeRepository")
 */
class Demande
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
     * @ORM\Column(name="address1", type="string", length=255)
     */
    private $address1;

    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="string", length=255)
     */
    private $address2;

    /**
     * @var int
     *
     * @ORM\Column(name="nbJobeur", type="smallint")
     */
    private $nbJobeur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateJob", type="date")
     */
    private $dateJob;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeJob", type="time")
     */
    private $timeJob;

    /**
     * @var int
     *
     * @ORM\Column(name="nbHour", type="smallint")
     */
    private $nbHour;

    /**
     * @var string
     *
     * @ORM\Column(name="priceHour", type="decimal", precision=10, scale=2)
     */
    private $priceHour;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=30)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="state", type="smallint")
     */
    private $state = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Alloservice\AdminBundle\Entity\Service", inversedBy="demandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $service;

    /**
     * @ORM\OneToMany(targetEntity="Alloservice\SiteBundle\Entity\Offre", mappedBy="demande")
     */
    private $offres;

    /**
     * @ORM\ManyToOne(targetEntity="Alloservice\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set address1
     *
     * @param string $address1
     *
     * @return Demande
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     *
     * @return Demande
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set nbJobeur
     *
     * @param integer $nbJobeur
     *
     * @return Demande
     */
    public function setNbJobeur($nbJobeur)
    {
        $this->nbJobeur = $nbJobeur;

        return $this;
    }

    /**
     * Get nbJobeur
     *
     * @return int
     */
    public function getNbJobeur()
    {
        return $this->nbJobeur;
    }

    /**
     * Set dateJob
     *
     * @param \DateTime $dateJob
     *
     * @return Demande
     */
    public function setDateJob($dateJob)
    {
        $this->dateJob = $dateJob;

        return $this;
    }

    /**
     * Get dateJob
     *
     * @return \DateTime
     */
    public function getDateJob()
    {
        return $this->dateJob;
    }

    /**
     * Set timeJob
     *
     * @param \DateTime $timeJob
     *
     * @return Demande
     */
    public function setTimeJob($timeJob)
    {
        $this->timeJob = $timeJob;

        return $this;
    }

    /**
     * Get timeJob
     *
     * @return \DateTime
     */
    public function getTimeJob()
    {
        return $this->timeJob;
    }

    /**
     * Set nbHour
     *
     * @param integer $nbHour
     *
     * @return Demande
     */
    public function setNbHour($nbHour)
    {
        $this->nbHour = $nbHour;

        return $this;
    }

    /**
     * Get nbHour
     *
     * @return int
     */
    public function getNbHour()
    {
        return $this->nbHour;
    }

    /**
     * Set priceHour
     *
     * @param string $priceHour
     *
     * @return Demande
     */
    public function setPriceHour($priceHour)
    {
        $this->priceHour = $priceHour;

        return $this;
    }

    /**
     * Get priceHour
     *
     * @return string
     */
    public function getPriceHour()
    {
        return $this->priceHour;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Demande
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Demande
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
     * Constructor
     */
    public function __construct()
    {
        $this->offres = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Demande
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set state
     *
     * @param integer $state
     *
     * @return Demande
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set service
     *
     * @param \Alloservice\AdminBundle\Entity\Service $service
     *
     * @return Demande
     */
    public function setService(\Alloservice\AdminBundle\Entity\Service $service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \Alloservice\AdminBundle\Entity\Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Add offre
     *
     * @param \Alloservice\SiteBundle\Entity\Offre $offre
     *
     * @return Demande
     */
    public function addOffre(\Alloservice\SiteBundle\Entity\Offre $offre)
    {
        $this->offres[] = $offre;

        return $this;
    }

    /**
     * Remove offre
     *
     * @param \Alloservice\SiteBundle\Entity\Offre $offre
     */
    public function removeOffre(\Alloservice\SiteBundle\Entity\Offre $offre)
    {
        $this->offres->removeElement($offre);
    }

    /**
     * Get offres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffres()
    {
        return $this->offres;
    }

    /**
     * Set user
     *
     * @param \Alloservice\UserBundle\Entity\User $user
     *
     * @return Demande
     */
    public function setUser(\Alloservice\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Alloservice\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
