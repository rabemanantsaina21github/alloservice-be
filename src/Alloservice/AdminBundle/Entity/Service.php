<?php

namespace Alloservice\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="Alloservice\AdminBundle\Repository\ServiceRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Service
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
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=100, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=255)
     */
    private $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="service_type", type="string", length=255)
     */
    private $serviceType;

    /**
     * @var string
     *
     * @ORM\Column(name="other_job", type="string", length=255)
     */
    private $otherJob;

    /**
     * @var string
     *
     * @ORM\Column(name="our_jobers", type="string", length=255)
     */
    private $ourJobers;

    /**
     * @var string
     *
     * @ORM\Column(name="last_service_pub", type="string", length=255)
     */
    private $lastServicePub;

    /**
     * @var string
     *
     * @ORM\Column(name="job_city", type="string", length=255)
     */
    private $jobCity;

    /**
     * @var string
     *
     * @ORM\Column(name="job_blog", type="string", length=255)
     */
    private $jobBlog;

    /**
     * @var string
     *
     * @ORM\Column(name="button_1", type="string", length=255)
     */
    private $button1;

    /**
     * @var string
     *
     * @ORM\Column(name="button_2", type="string", length=255)
     */
    private $button2;

    /**
     * @var string
     *
     * @ORM\Column(name="button_3", type="string", length=255)
     */
    private $button3;

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="string", length=255)
     */
    private $src;

    /**
     * @Assert\Image(maxSize="2M", minWidth=450, maxWidth=450, minHeight=300, maxHeight=300)
     */
    private $file;
    private $temp;

    /**
     * @ORM\ManyToOne(targetEntity="Alloservice\AdminBundle\Entity\Service", inversedBy="services")
     * @ORM\JoinColumn(nullable=true)
     */
    private $service;

    /**
     * @ORM\OneToMany(targetEntity="Alloservice\AdminBundle\Entity\Service", mappedBy="service", cascade={"remove"})
     */
    private $services;

    /**
     * @ORM\ManyToOne(targetEntity="Alloservice\AdminBundle\Entity\Service", inversedBy="subServices")
     * @ORM\JoinColumn(nullable=true)
     */
    private $supService;

    /**
     * @ORM\OneToMany(targetEntity="Alloservice\AdminBundle\Entity\Service", mappedBy="supService", cascade={"remove"})
     */
    private $subServices;

    /**
     * @ORM\OneToMany(targetEntity="Alloservice\SiteBundle\Entity\Demande", mappedBy="service")
     */
    private $demandes;


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
     * @return Service
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Service
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
     * Constructor
     */
    public function __construct()
    {
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
        return 'uploads/service';
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
     * Set description
     *
     * @param string $description
     *
     * @return Service
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
     * Set service
     *
     * @param \Alloservice\AdminBundle\Entity\Service $service
     *
     * @return Service
     */
    public function setService(\Alloservice\AdminBundle\Entity\Service $service = null)
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
     * Add service
     *
     * @param \Alloservice\AdminBundle\Entity\Service $service
     *
     * @return Service
     */
    public function addService(\Alloservice\AdminBundle\Entity\Service $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param \Alloservice\AdminBundle\Entity\Service $service
     */
    public function removeService(\Alloservice\AdminBundle\Entity\Service $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Set supService
     *
     * @param \Alloservice\AdminBundle\Entity\Service $supService
     *
     * @return Service
     */
    public function setSupService(\Alloservice\AdminBundle\Entity\Service $supService = null)
    {
        $this->supService = $supService;

        return $this;
    }

    /**
     * Get supService
     *
     * @return \Alloservice\AdminBundle\Entity\Service
     */
    public function getSupService()
    {
        return $this->supService;
    }

    /**
     * Add subService
     *
     * @param \Alloservice\AdminBundle\Entity\Service $subService
     *
     * @return Service
     */
    public function addSubService(\Alloservice\AdminBundle\Entity\Service $subService)
    {
        $this->subServices[] = $subService;

        return $this;
    }

    /**
     * Remove subService
     *
     * @param \Alloservice\AdminBundle\Entity\Service $subService
     */
    public function removeSubService(\Alloservice\AdminBundle\Entity\Service $subService)
    {
        $this->subServices->removeElement($subService);
    }

    /**
     * Get subServices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubServices()
    {
        return $this->subServices;
    }

    /**
     * Add demande
     *
     * @param \Alloservice\SiteBundle\Entity\Demande $demande
     *
     * @return Service
     */
    public function addDemande(\Alloservice\SiteBundle\Entity\Demande $demande)
    {
        $this->demandes[] = $demande;

        return $this;
    }

    /**
     * Remove demande
     *
     * @param \Alloservice\SiteBundle\Entity\Demande $demande
     */
    public function removeDemande(\Alloservice\SiteBundle\Entity\Demande $demande)
    {
        $this->demandes->removeElement($demande);
    }

    /**
     * Get demandes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDemandes()
    {
        return $this->demandes;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     *
     * @return Service
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set serviceType
     *
     * @param string $serviceType
     *
     * @return Service
     */
    public function setServiceType($serviceType)
    {
        $this->serviceType = $serviceType;

        return $this;
    }

    /**
     * Get serviceType
     *
     * @return string
     */
    public function getServiceType()
    {
        return $this->serviceType;
    }

    /**
     * Set otherJob
     *
     * @param string $otherJob
     *
     * @return Service
     */
    public function setOtherJob($otherJob)
    {
        $this->otherJob = $otherJob;

        return $this;
    }

    /**
     * Get otherJob
     *
     * @return string
     */
    public function getOtherJob()
    {
        return $this->otherJob;
    }

    /**
     * Set ourJobers
     *
     * @param string $ourJobers
     *
     * @return Service
     */
    public function setOurJobers($ourJobers)
    {
        $this->ourJobers = $ourJobers;

        return $this;
    }

    /**
     * Get ourJobers
     *
     * @return string
     */
    public function getOurJobers()
    {
        return $this->ourJobers;
    }

    /**
     * Set lastServicePub
     *
     * @param string $lastServicePub
     *
     * @return Service
     */
    public function setLastServicePub($lastServicePub)
    {
        $this->lastServicePub = $lastServicePub;

        return $this;
    }

    /**
     * Get lastServicePub
     *
     * @return string
     */
    public function getLastServicePub()
    {
        return $this->lastServicePub;
    }

    /**
     * Set jobCity
     *
     * @param string $jobCity
     *
     * @return Service
     */
    public function setJobCity($jobCity)
    {
        $this->jobCity = $jobCity;

        return $this;
    }

    /**
     * Get jobCity
     *
     * @return string
     */
    public function getJobCity()
    {
        return $this->jobCity;
    }

    /**
     * Set jobBlog
     *
     * @param string $jobBlog
     *
     * @return Service
     */
    public function setJobBlog($jobBlog)
    {
        $this->jobBlog = $jobBlog;

        return $this;
    }

    /**
     * Get jobBlog
     *
     * @return string
     */
    public function getJobBlog()
    {
        return $this->jobBlog;
    }

    /**
     * Set button1
     *
     * @param string $button1
     *
     * @return Service
     */
    public function setButton1($button1)
    {
        $this->button1 = $button1;

        return $this;
    }

    /**
     * Get button1
     *
     * @return string
     */
    public function getButton1()
    {
        return $this->button1;
    }

    /**
     * Set button2
     *
     * @param string $button2
     *
     * @return Service
     */
    public function setButton2($button2)
    {
        $this->button2 = $button2;

        return $this;
    }

    /**
     * Get button2
     *
     * @return string
     */
    public function getButton2()
    {
        return $this->button2;
    }

    /**
     * Set button3
     *
     * @param string $button3
     *
     * @return Service
     */
    public function setButton3($button3)
    {
        $this->button3 = $button3;

        return $this;
    }

    /**
     * Get button3
     *
     * @return string
     */
    public function getButton3()
    {
        return $this->button3;
    }
}
