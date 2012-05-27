<?php

namespace Fran\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fran\PostBundle\Entity\Taxonomy
 *
 * @ORM\Table(name="taxonomy")
 * @ORM\Entity(repositoryClass="Fran\PostBundle\Entity\TaxonomyRepository")
 */
class Taxonomy
{
    const CATEGORY = 0;
    const TAG = 1;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var smallint $type
     *
     * @ORM\Column(name="type", type="smallint")
     */
    protected $type;

    /**
     * @ORM\ManyToMany(targetEntity="Fran\PostBundle\Entity\Post", mappedBy="taxonomies")
     */
    protected $posts;

    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Set type
     *
     * @param smallint $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return smallint 
     */
    public function getType()
    {
        return $this->type;
    }

    public static function getTypes()
    {
        return array(
            self::CATEGORY  => 'Category',
            self::TAG       => 'Tag'
        );
    }

    public function getNamedType()
    {
        $types = self::getTypes();
        if (isset($types[$this->type])) {
            return $types[$this->type];
        }
        return null;

    }

    public function isTag()
    {
        return $this->type == self::TAG;
    }

    public function isCategory()
    {
        return $this->type == self::CATEGORY;
    }
    
    /**
     * Add posts
     *
     * @param Fran\PostBundle\Entity\Post $posts
     */
    public function addPost(\Fran\PostBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;
    }

    /**
     * Get posts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }

    public function __toString()
    {
        return $this->name;
    }
}