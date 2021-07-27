<?php

namespace Alloservice\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Section
 *
 * @ORM\Table(name="section")
 * @ORM\Entity(repositoryClass="Alloservice\AdminBundle\Repository\SectionRepository")
 */
class Section
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle1", type="string", length=255, nullable=true)
     */
    private $subtitle1;

    /**
     * @var string
     *
     * @ORM\Column(name="img1", type="string", length=255, nullable=true)
     */
    private $img1;

    /**
     * @var string
     *
     * @ORM\Column(name="text1", type="text", nullable=true)
     */
    private $text1;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle2", type="string", length=255, nullable=true)
     */
    private $subtitle2;

    /**
     * @var string
     *
     * @ORM\Column(name="img2", type="string", length=255, nullable=true)
     */
    private $img2;

    /**
     * @var string
     *
     * @ORM\Column(name="text2", type="text", nullable=true)
     */
    private $text2;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle3", type="string", length=255, nullable=true)
     */
    private $subtitle3;

    /**
     * @var string
     *
     * @ORM\Column(name="img3", type="string", length=255, nullable=true)
     */
    private $img3;

    /**
     * @var string
     *
     * @ORM\Column(name="text3", type="text", nullable=true)
     */
    private $text3;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle4", type="string", length=255, nullable=true)
     */
    private $subtitle4;

    /**
     * @var string
     *
     * @ORM\Column(name="img4", type="string", length=255, nullable=true)
     */
    private $img4;

    /**
     * @var string
     *
     * @ORM\Column(name="text4", type="text", nullable=true)
     */
    private $text4;


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
     * Set title
     *
     * @param string $title
     *
     * @return Section
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Section
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
     * Set subtitle1
     *
     * @param string $subtitle1
     *
     * @return Section
     */
    public function setSubtitle1($subtitle1)
    {
        $this->subtitle1 = $subtitle1;

        return $this;
    }

    /**
     * Get subtitle1
     *
     * @return string
     */
    public function getSubtitle1()
    {
        return $this->subtitle1;
    }

    /**
     * Set img1
     *
     * @param string $img1
     *
     * @return Section
     */
    public function setImg1($img1)
    {
        $this->img1 = $img1;

        return $this;
    }

    /**
     * Get img1
     *
     * @return string
     */
    public function getImg1()
    {
        return $this->img1;
    }

    /**
     * Set text1
     *
     * @param string $text1
     *
     * @return Section
     */
    public function setText1($text1)
    {
        $this->text1 = $text1;

        return $this;
    }

    /**
     * Get text1
     *
     * @return string
     */
    public function getText1()
    {
        return $this->text1;
    }

    /**
     * Set subtitle2
     *
     * @param string $subtitle2
     *
     * @return Section
     */
    public function setSubtitle2($subtitle2)
    {
        $this->subtitle2 = $subtitle2;

        return $this;
    }

    /**
     * Get subtitle2
     *
     * @return string
     */
    public function getSubtitle2()
    {
        return $this->subtitle2;
    }

    /**
     * Set img2
     *
     * @param string $img2
     *
     * @return Section
     */
    public function setImg2($img2)
    {
        $this->img2 = $img2;

        return $this;
    }

    /**
     * Get img2
     *
     * @return string
     */
    public function getImg2()
    {
        return $this->img2;
    }

    /**
     * Set text2
     *
     * @param string $text2
     *
     * @return Section
     */
    public function setText2($text2)
    {
        $this->text2 = $text2;

        return $this;
    }

    /**
     * Get text2
     *
     * @return string
     */
    public function getText2()
    {
        return $this->text2;
    }

    /**
     * Set subtitle3
     *
     * @param string $subtitle3
     *
     * @return Section
     */
    public function setSubtitle3($subtitle3)
    {
        $this->subtitle3 = $subtitle3;

        return $this;
    }

    /**
     * Get subtitle3
     *
     * @return string
     */
    public function getSubtitle3()
    {
        return $this->subtitle3;
    }

    /**
     * Set img3
     *
     * @param string $img3
     *
     * @return Section
     */
    public function setImg3($img3)
    {
        $this->img3 = $img3;

        return $this;
    }

    /**
     * Get img3
     *
     * @return string
     */
    public function getImg3()
    {
        return $this->img3;
    }

    /**
     * Set text3
     *
     * @param string $text3
     *
     * @return Section
     */
    public function setText3($text3)
    {
        $this->text3 = $text3;

        return $this;
    }

    /**
     * Get text3
     *
     * @return string
     */
    public function getText3()
    {
        return $this->text3;
    }

    /**
     * Set subtitle4
     *
     * @param string $subtitle4
     *
     * @return Section
     */
    public function setSubtitle4($subtitle4)
    {
        $this->subtitle4 = $subtitle4;

        return $this;
    }

    /**
     * Get subtitle4
     *
     * @return string
     */
    public function getSubtitle4()
    {
        return $this->subtitle4;
    }

    /**
     * Set img4
     *
     * @param string $img4
     *
     * @return Section
     */
    public function setImg4($img4)
    {
        $this->img4 = $img4;

        return $this;
    }

    /**
     * Get img4
     *
     * @return string
     */
    public function getImg4()
    {
        return $this->img4;
    }

    /**
     * Set text4
     *
     * @param string $text4
     *
     * @return Section
     */
    public function setText4($text4)
    {
        $this->text4 = $text4;

        return $this;
    }

    /**
     * Get text4
     *
     * @return string
     */
    public function getText4()
    {
        return $this->text4;
    }
}

