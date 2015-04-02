<?php

namespace HB\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Image
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="HB\BlogBundle\Entity\ImageRepository")
 */
class Image
{
    /**
     * @var integer
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
     * @ORM\Column(name="alt", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text")
     * @Assert\NotBlank()
     * Assert\File(maxSize="600000000000")
     */
    private $url;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Image
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
     * Set alt
     *
     * @param string $alt
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }
    
    public function getAbsolutePath()
    {
        return null === $this->url ? null : $this->getUploadRootDir().'/'.$this->url;
    }

    public function getWebPath()
    {
        return null === $this->url ? null : $this->getUploadDir().'/'.$this->url;
    }

    public function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    public function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/images';
    }
    
    public function upload()
    {
        // la propriété « file » peut être vide si le champ n'est pas requis
        if (null === $this->url) {
            return;
        }

        // utilisez le nom de fichier original ici mais
        // vous devriez « l'assainir » pour au moins éviter
        // quelconques problèmes de sécurité

        // la méthode « move » prend comme arguments le répertoire cible et
        // le nom de fichier cible où le fichier doit être déplacé
        $this->url->move($this->getUploadRootDir(), $this->url->getClientOriginalName());

//        $this->banner->url->move($this->banner->url->getUploadRootDir(), $this->banner->url->getClientOriginalName());

        // définit la propriété « path » comme étant le nom de fichier où vous
        // avez stocké le fichier
        $this->url = $this->url->getClientOriginalName();

        // « nettoie » la propriété « file » comme vous n'en aurez plus besoin
        //$this->file = null;
    }
}
