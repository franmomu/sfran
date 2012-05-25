<?php

namespace Fran\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fran\PostBundle\Entity\Post
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Fran\PostBundle\Entity\PostRepository")
 */
class Post
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\ManyToMany(targetEntity="Fran\PostBundle\Entity\Taxonomy", inversedBy="posts")
     * @ORM\JoinTable(name="post_taxonomy")
     */
    protected $taxonomies;

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
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
    public function __construct()
    {
        $this->taxonomies = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add taxonomies
     *
     * @param Fran\PostBundle\Entity\Taxonomy $taxonomies
     */
    public function addTaxonomy(\Fran\PostBundle\Entity\Taxonomy $taxonomies)
    {
        $this->taxonomies[] = $taxonomies;
    }

    /**
     * Get taxonomies
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTaxonomies()
    {
        return $this->taxonomies;
    }
}