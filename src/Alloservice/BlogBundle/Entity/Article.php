<?php

namespace Alloservice\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="Alloservice\BlogBundle\Repository\ArticleRepository")
 * @UniqueEntity(fields="title")
 * @ORM\HasLifecycleCallbacks
 */
class Article
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
     * @ORM\Column(name="title", type="string", length=100, unique=true)
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=100, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=255)
     */
    private $subtitle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var bool
     *
     * @ORM\Column(name="state", type="boolean")
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="string", length=255)
     */
    private $src;

    /**
     * @Assert\Image(maxSize="3M", minWidth=900, minHeight=480)
     */
    private $file;
    private $temp;

    /**
     * @ORM\ManyToOne(targetEntity="Alloservice\BlogBundle\Entity\ArticleCategory", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;


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
     * @return Article
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
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return Article
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Article
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
     * Set content
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set state
     *
     * @param boolean $state
     *
     * @return Article
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return bool
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set src
     *
     * @param string $src
     *
     * @return Article
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
        $this->removeThumb();
    }
    
    public function getUploadDir()
    {
        return 'uploads/blog/image';
    }
    
    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function removeThumb()
    {
        $tab = ['300x200','720x480','900x300'];
        foreach ($tab as $type) {
            $url = __DIR__.'/../../../../web/media/cache/'.$type.'/'.$this->getUploadDir().'/'.$this->temp;
            if (file_exists($url)) {
                @unlink($url);
            }
        }
    }
    
    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->getSrc();
    }

    public function getThumbPath()
    {
        return '/uploads/blog/image'.'/'.$this->getSrc();
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Article
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
     * Set category
     *
     * @param \Alloservice\BlogBundle\Entity\ArticleCategory $category
     *
     * @return Article
     */
    public function setCategory(\Alloservice\BlogBundle\Entity\ArticleCategory $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Alloservice\BlogBundle\Entity\ArticleCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
}
