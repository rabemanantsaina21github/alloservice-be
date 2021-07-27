<?php

namespace Alloservice\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Partner
 *
 * @ORM\Table(name="partner")
 * @ORM\Entity(repositoryClass="Alloservice\SiteBundle\Repository\PartnerRepository")
 * @UniqueEntity(fields="name")
 * @ORM\HasLifecycleCallbacks
 */
class Partner
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
     * @ORM\Column(name="name", type="string", length=100, unique=true)
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
     * @ORM\Column(name="src", type="string", length=255, nullable=true)
     */
    private $src;

    /**
     * @var string
     *
     * @ORM\Column(name="svg", type="text", nullable=true)
     */
    private $svg;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @Assert\Image(maxSize="3M", minWidth=120, minHeight=120)
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
     * @return Partner
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Partner
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
     * @return Partner
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

    /**
     * Set svg
     *
     * @param string $svg
     *
     * @return Partner
     */
    public function setSvg($svg)
    {
        $this->svg = $svg;

        return $this;
    }

    /**
     * Get svg
     *
     * @return string
     */
    public function getSvg()
    {
        return $this->svg;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Partner
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

    public function setTemp($temp)
    {
        $this->temp = $temp;

        return $this;
    }

    public function getTemp()
    {
        return $this->temp;
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
        $this->temp = $this->src;
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $temp = $this->getUploadRootDir().'/'.$this->temp;
        if (file_exists($temp)) {
            @unlink($temp);
        }
    }
    
    public function getUploadDir()
    {
        return 'uploads/partner';
    }
    
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    
    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->getSrc();
    }

    /**
     * @Assert\IsTrue(message="Le champ svg et le champ image ne peuvent pas être vide en même temps.")
     */
    public function isOk()
    {
        if(!is_null($this->file) OR !is_null($this->svg)) {
            return true;
        }
        return false;
    }
}

