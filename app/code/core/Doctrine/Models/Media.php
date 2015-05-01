<?php

namespace Doctrine\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Media
 *
 * @ORM\Table(name="pr_medias")
 * @ORM\Entity
 */
class Media
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Doctrine\Models\Post", mappedBy="medias")
     */
    private $post_parent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->post_parent = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add post_parent
     *
     * @param \Doctrine\Models\Post $postParent
     * @return Media
     */
    public function addPostParent(\Doctrine\Models\Post $postParent)
    {
        $this->post_parent[] = $postParent;
    
        return $this;
    }

    /**
     * Remove post_parent
     *
     * @param \Doctrine\Models\Post $postParent
     */
    public function removePostParent(\Doctrine\Models\Post $postParent)
    {
        $this->post_parent->removeElement($postParent);
    }

    /**
     * Get post_parent
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostParent()
    {
        return $this->post_parent;
    }
}