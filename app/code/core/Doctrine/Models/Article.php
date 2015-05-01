<?php

namespace Doctrine\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="pr_articles")
 * @ORM\Entity
 */
class Article
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="short_content", type="string", length=255)
     */
    private $short_content;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Doctrine\Models\Post
     *
     * @ORM\OneToOne(targetEntity="Doctrine\Models\Post", orphanRemoval=true)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_id", referencedColumnName="id", unique=true)
     * })
     */
    private $post;


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
     * Set short_content
     *
     * @param string $shortContent
     * @return Article
     */
    public function setShortContent($shortContent)
    {
        $this->short_content = $shortContent;
    
        return $this;
    }

    /**
     * Get short_content
     *
     * @return string 
     */
    public function getShortContent()
    {
        return $this->short_content;
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
     * Set post
     *
     * @param \Doctrine\Models\Post $post
     * @return Article
     */
    public function setPost(\Doctrine\Models\Post $post = null)
    {
        $this->post = $post;
    
        return $this;
    }

    /**
     * Get post
     *
     * @return \Doctrine\Models\Post 
     */
    public function getPost()
    {
        return $this->post;
    }
}