<?php

namespace HB\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="HB\BlogBundle\Entity\ArticleRepository")
 */
class Article
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
     * @Assert\Length(
     *      min = "10",
     *      max = "100",
     *      minMessage = "Votre titre doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre titre ne peut pas être plus long que {{ limit }} caractères"
     * )
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\Length(
     *      min = "10",
     *      minMessage = "Votre titre doit faire au moins {{ limit }} caractères"
     * )
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     * @Assert\DateTime(message = "La date de création n'est pas au format date")
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastEditDate", type="datetime", nullable=true)
     * @Assert\DateTime(message = "La date de modification n'est pas au format date")
     */
    private $lastEditDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publishDate", type="datetime")
     * @Assert\DateTime(message = "La date de publication n'est pas au format date")
     */
    private $publishDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean")
     * @Assert\Type(type="boolean", message="La valeur {{ value }} n'est pas un type {{ type }} valide.")
     */
    private $published;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     * @Assert\Type(type="boolean", message="La valeur {{ value }} n'est pas un type {{ type }} valide.")
     */
    private $enabled;
    
    /**
     *
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="articles")
     * @Assert\Valid()
     */
    private $author;
    
     /**
     *
     * @var Image
     * 
     * @ORM\OneToOne(targetEntity="Image", cascade="persist")
     * @Assert\Valid()
     */
    private $banner;
    
     /**
     *
     * @var Comments[]
     * 
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="article") 
     */
    private $comments;
    
    public function __construct() {
        //  valeur par défaut (notamment pour le formulaire)
        $this->creationDate = new \DateTime();
        $this->publishDate = new \DateTime();
        $this->enabled = true;
    }

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
     * Set content
     *
     * @param string $content
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Article
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set lastEditDate
     *
     * @param \DateTime $lastEditDate
     * @return Article
     */
    public function setLastEditDate($lastEditDate)
    {
        $this->lastEditDate = $lastEditDate;

        return $this;
    }

    /**
     * Get lastEditDate
     *
     * @return \DateTime 
     */
    public function getLastEditDate()
    {
        return $this->lastEditDate;
    }

    /**
     * Set publishDate
     *
     * @param \DateTime $publishDate
     * @return Article
     */
    public function setPublishDate($publishDate)
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    /**
     * Get publishDate
     *
     * @return \DateTime 
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Article
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Article
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set author
     *
     * @param \HB\BlogBundle\Entity\User $author
     * @return Article
     */
    public function setAuthor(\HB\BlogBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Set author
     *
     * @param \HB\BlogBundle\Entity\User $author
     * @return Article
     */
    public function setAuthorById(int $authorId)
    {
        $em = $this->getDoctrine()->getManager();

        $author = $em->getRepository('HBBlogBundle:User')->find($authorId);
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \HB\BlogBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Add comments
     *
     * @param \HB\BlogBundle\Entity\Comment $comments
     * @return Article
     */
    public function addComment(\HB\BlogBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \HB\BlogBundle\Entity\Comment $comments
     */
    public function removeComment(\HB\BlogBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set banner
     *
     * @param \HB\BlogBundle\Entity\Image $banner
     * @return Article
     */
    public function setBanner(\HB\BlogBundle\Entity\Image $banner = null)
    {
        $this->banner = $banner;

        return $this;
    }

    /**
     * Get banner
     *
     * @return \HB\BlogBundle\Entity\Image 
     */
    public function getBanner()
    {
        return $this->banner;
    }
    

}
