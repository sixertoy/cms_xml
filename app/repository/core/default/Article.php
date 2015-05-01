<?php

namespace Pure\Entity;

use Doctrine\ORM\Mapping\PrePersist;

use DateTime;
use Pure\Entity\Post;

class Article
{
	
	public function construct()
	{
		$this->post = new Post();
	}
	
	public function setTitle( $value )
	{
		$this->post->setTitle( $value );
	}
	
	public function setDescription( $value )
	{
		$this->post->setDescription( $value );
	}
	
	public function setName( $value )
	{
		$this->post->setName( $value );
	}
	
	public function setRoute( $value )
	{
		$this->post->setRoute( $value );
	}
	
	public function setStatus( $value )
	{
		$this->post->setStatus( $value );
	}
	
	public function setUser( $value )
	{
		$this->post->setUser( $value );
	}
	
	public function setCreated( $value )
	{
		$this->post->setCreated( $value );
	}
	
	public function setModified( $value )
	{
		$this->post->setModified( $value );
	}
	
}