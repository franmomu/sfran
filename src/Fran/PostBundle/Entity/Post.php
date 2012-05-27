<?php

namespace Fran\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fran\PostBundle\Entity\Post
 *
 * @ORM\Table(name="post")
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

    protected $tags;

    protected $categories;

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

    public function getTags()
    {
        if (isset($this->tags)) {
            return $this->tags;
        }
        $tags = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->taxonomies as $tag) {
            if($tag->isTag()) {
                $tags[] = $tag;
            }
        }

        return $tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
        foreach ($tags as $tag) {
            if (!$this->taxonomies->contains($tag)) {
                $this->addTaxonomy($tag);
            }
        }
    }

    public function getCategories()
    {
        if (isset($this->categories)) {
            return $this->categories;
        }
        $categories = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->taxonomies as $taxonomy) {
            if($taxonomy->isCategory()) {
                $categories[] = $taxonomy;
            }
        }

        return $categories;
    }

    public function setCategories($categories)
    {
        $this->categories = $categories;
        foreach ($categories as $category) {
            if (!$this->taxonomies->contains($category)) {
                $this->addTaxonomy($category);
            }
        }
    }

    public function __toString()
    {
        return $this->title;
    }
}