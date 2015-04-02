<?php

namespace HB\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="HB\BlogBundle\Entity\CommentRepository")
 */
class Comment
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
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="LastEditDate", type="datetime")
     */
    private $lastEditDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="adminValidation", type="boolean")
     */
    private $adminValidation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="validationDate", type="datetime")
     */
    private $validationDate;
    
    /**
     *
     * @var String
     * @ORM\Column(name="authorName", type="string", length=50)
     * @Assert\Length(
     *      min = "5",
     *      max = "50",
     *      minMessage = "Votre nom doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre nom ne peut pas être plus long que {{ limit }} caractères"
     * )
     */
    private $authorName;
    
    /**
     *
     * @var int 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     */
    private $author;

        /**
     *
     * @var Article
     * 
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="comments")
     * @Assert\Valid()
     */
    private $article;
    
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
     * Set comment
     *
     * @param string $comment
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Comment
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
     * @return Comment
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
     * Set adminValidation
     *
     * @param boolean $adminValidation
     * @return Comment
     */
    public function setAdminValidation($adminValidation)
    {
        $this->adminValidation = $adminValidation;

        return $this;
    }

    /**
     * Get adminValidation
     *
     * @return boolean 
     */
    public function getAdminValidation()
    {
        return $this->adminValidation;
    }

    /**
     * Set validationDate
     *
     * @param \DateTime $validationDate
     * @return Comment
     */
    public function setValidationDate($validationDate)
    {
        $this->validationDate = $validationDate;

        return $this;
    }

    /**
     * Get validationDate
     *
     * @return \DateTime 
     */
    public function getValidationDate()
    {
        return $this->validationDate;
    }

    /**
     * Set authorName
     *
     * @param string $authorName
     * @return Comment
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;

        return $this;
    }

    /**
     * Get authorName
     *
     * @return string 
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * Set author
     *
     * @param \HB\BlogBundle\Entity\User $author
     * @return Comment
     */
    public function setAuthor(\HB\BlogBundle\Entity\User $author = null)
    {
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
     * Set article
     *
     * @param \HB\BlogBundle\Entity\Article $article
     * @return Comment
     */
    public function setArticle(\HB\BlogBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \HB\BlogBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }
}
