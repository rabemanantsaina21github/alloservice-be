<?php

namespace Alloservice\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avis
 *
 * @ORM\Table(name="avis")
 * @ORM\Entity(repositoryClass="Alloservice\SiteBundle\Repository\AvisRepository")
 */
class Avis
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
     * @var int
     *
     * @ORM\Column(name="note1", type="smallint")
     */
    private $note1 = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="note2", type="smallint")
     */
    private $note2 = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="note3", type="smallint")
     */
    private $note3 = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="note4", type="smallint")
     */
    private $note4 = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="note5", type="smallint")
     */
    private $note5 = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="noteGlobal", type="smallint")
     */
    private $noteGlobal;

    /**
     * @ORM\OneToOne(targetEntity="Alloservice\SiteBundle\Entity\Demande")
     * @ORM\JoinColumn(nullable=false)
     */
    private $demande;

    /**
     * @ORM\OneToOne(targetEntity="Alloservice\SiteBundle\Entity\Offre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offre;


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
     * Set note1
     *
     * @param integer $note1
     *
     * @return Avis
     */
    public function setNote1($note1)
    {
        $this->note1 = $note1;

        return $this;
    }

    /**
     * Get note1
     *
     * @return int
     */
    public function getNote1()
    {
        return $this->note1;
    }

    /**
     * Set note2
     *
     * @param integer $note2
     *
     * @return Avis
     */
    public function setNote2($note2)
    {
        $this->note2 = $note2;

        return $this;
    }

    /**
     * Get note2
     *
     * @return int
     */
    public function getNote2()
    {
        return $this->note2;
    }

    /**
     * Set note3
     *
     * @param integer $note3
     *
     * @return Avis
     */
    public function setNote3($note3)
    {
        $this->note3 = $note3;

        return $this;
    }

    /**
     * Get note3
     *
     * @return int
     */
    public function getNote3()
    {
        return $this->note3;
    }

    /**
     * Set note4
     *
     * @param integer $note4
     *
     * @return Avis
     */
    public function setNote4($note4)
    {
        $this->note4 = $note4;

        return $this;
    }

    /**
     * Get note4
     *
     * @return int
     */
    public function getNote4()
    {
        return $this->note4;
    }

    /**
     * Set note5
     *
     * @param integer $note5
     *
     * @return Avis
     */
    public function setNote5($note5)
    {
        $this->note5 = $note5;

        return $this;
    }

    /**
     * Get note5
     *
     * @return int
     */
    public function getNote5()
    {
        return $this->note5;
    }

    /**
     * Set noteGlobal
     *
     * @param integer $noteGlobal
     *
     * @return Avis
     */
    public function setNoteGlobal($noteGlobal)
    {
        $this->noteGlobal = $noteGlobal;

        return $this;
    }

    /**
     * Get noteGlobal
     *
     * @return int
     */
    public function getNoteGlobal()
    {
        return $this->noteGlobal;
    }

    /**
     * Set demande
     *
     * @param \Alloservice\SiteBundle\Entity\Demande $demande
     *
     * @return Avis
     */
    public function setDemande(\Alloservice\SiteBundle\Entity\Demande $demande)
    {
        $this->demande = $demande;

        return $this;
    }

    /**
     * Get demande
     *
     * @return \Alloservice\SiteBundle\Entity\Demande
     */
    public function getDemande()
    {
        return $this->demande;
    }

    /**
     * Set offre
     *
     * @param \Alloservice\SiteBundle\Entity\Offre $offre
     *
     * @return Avis
     */
    public function setOffre(\Alloservice\SiteBundle\Entity\Offre $offre)
    {
        $this->offre = $offre;

        return $this;
    }

    /**
     * Get offre
     *
     * @return \Alloservice\SiteBundle\Entity\Offre
     */
    public function getOffre()
    {
        return $this->offre;
    }
}
