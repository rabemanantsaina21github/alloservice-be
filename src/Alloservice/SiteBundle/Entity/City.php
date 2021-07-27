<?php

namespace Alloservice\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * City
 *
 * @ORM\Table(name="city")
 * @ORM\Entity(repositoryClass="Alloservice\SiteBundle\Repository\CityRepository")
 * @UniqueEntity(fields={"name","cp"}, message="Cette ville existe déjà dans la base de données.")
 * @ORM\HasLifecycleCallbacks
 */
class City
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=100, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=10)
     */
    private $cp;

    /**
     * @ORM\ManyToOne(targetEntity="Alloservice\SiteBundle\Entity\Country", inversedBy="cities")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="string", length=255)
     */
    private $src;

    /**
     * @Assert\Image(maxSize="2M", minWidth=300, maxWidth=354, minHeight=169, maxHeight=234)
     */
    private $file;
    private $temp;


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
     * Set name
     *
     * @param string $name
     *
     * @return City
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
     * Set cp
     *
     * @param string $cp
     *
     * @return City
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set country
     *
     * @param \Alloservice\SiteBundle\Entity\Country $country
     *
     * @return City
     */
    public function setCountry(\Alloservice\SiteBundle\Entity\Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Alloservice\SiteBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return City
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set src
     *
     * @param string $src
     *
     * @return Service
     */
    public function setSrc($src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Get src
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    public function setTemp($temp)
    {
        $this->temp = $temp;

        return $this;
    }

    public function getTemp()
    {
        return $this->temp;
    }

    public function setFile(UploadedFile $file)
    {
        $this->file = $file;
        if (!is_null($this->src)) {
            $this->temp = $this->src;
            $this->src = null;
        }

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (is_null($this->file)) {
            return;
        }
        
        $this->src = md5(uniqid()).'.'.$this->file->guessExtension();
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (is_null($this->file)) {
            return;
        }
        
        if (!is_null($this->temp)) {
            $oldFile = $this->getUploadRootDir().'/'.$this->temp;
            if (file_exists($oldFile)) {
                @unlink($oldFile);
            }
        }
        $this->file->move(
            $this->getUploadRootDir(),$this->src
        );
    }
    
    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->temp = $this->getUploadRootDir().'/'.$this->src;
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (file_exists($this->temp)) {
            @unlink($this->temp);
        }
    }
    
    public function getUploadDir()
    {
        return 'uploads/city';
    }
    
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    
    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->getSrc();
    }
}
