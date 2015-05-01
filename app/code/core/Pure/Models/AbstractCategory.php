<?php
namespace Pure\Models;

use Doctrine\Models\Post;
use Doctrine\Models\Publication;

use Doctrine\ORM\EntityRepository;

class AbstractCategory extends EntityRepository
{
	
	public function __construct( $em, $class )
	{
		parent( $em, $class );
		
		$now = new DateTime( "NOW" ); 
		$this->_metas = new Publication();
		$this->_metas->setCreated( $now );
		$this->_metas->setModified( $now );
		
		$this->_post = new Post();
	}
}