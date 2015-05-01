<?php

namespace Pure\Models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Pure\Models\Term
 *
 * @ORM\Entity()
 * @ORM\Table(name="pr_terms")
 */
class Term
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $term_id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $label;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="term")
     * @ORM\JoinColumn(name="term_id", referencedColumnName="term_id")
     */
    protected $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * Set the value of term_id.
     *
     * @param integer $term_id
     * @return \Pure\Models\Term
     */
    public function setTermId($term_id)
    {
        $this->term_id = $term_id;

        return $this;
    }

    /**
     * Get the value of term_id.
     *
     * @return integer
     */
    public function getTermId()
    {
        return $this->term_id;
    }

    /**
     * Set the value of label.
     *
     * @param string $label
     * @return \Pure\Models\Term
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get the value of label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set the value of name.
     *
     * @param string $name
     * @return \Pure\Models\Term
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add Post entity to collection (one to many).
     *
     * @param \Pure\Models\Post $post
     * @return \Pure\Models\Term
     */
    public function addPost(Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Get Post entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    public function __sleep()
    {
        return array('term_id', 'label', 'name');
    }
}