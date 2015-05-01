<?php

namespace Doctrine\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="pr_posts")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Post
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Doctrine\Models\Publication
     *
     * @ORM\ManyToOne(targetEntity="Doctrine\Models\Publication")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="publication_id", referencedColumnName="id")
     * })
     */
    private $publication;

    /**
     * @var \Doctrine\Models\Type
     *
     * @ORM\ManyToOne(targetEntity="Doctrine\Models\Type", inversedBy="posts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;

    /**
     * @var \Doctrine\Models\Media
     *
     * @ORM\ManyToOne(targetEntity="Doctrine\Models\Media", inversedBy="post_parent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="medias_id", referencedColumnName="id")
     * })
     */
    private $medias;


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
     * Set publication
     *
     * @param \Doctrine\Models\Publication $publication
     * @return Post
     */
    public function setPublication(\Doctrine\Models\Publication $publication = null)
    {
        $this->publication = $publication;
    
        return $this;
    }

    /**
     * Get publication
     *
     * @return \Doctrine\Models\Publication 
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set type
     *
     * @param \Doctrine\Models\Type $type
     * @return Post
     */
    public function setType(\Doctrine\Models\Type $type = null)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return \Doctrine\Models\Type 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set medias
     *
     * @param \Doctrine\Models\Media $medias
     * @return Post
     */
    public function setMedias(\Doctrine\Models\Media $medias = null)
    {
        $this->medias = $medias;
    
        return $this;
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Models\Media 
     */
    public function getMedias()
    {
        return $this->medias;
    }
    /**
     * @ORM\PrePersist
     */
    public function sanitizeName()
    {
        // Add your code here
    }

    /**
     * @ORM\PrePersist
     */
    public function sanitizeRoute()
    {
        // Add your code here
    }
}