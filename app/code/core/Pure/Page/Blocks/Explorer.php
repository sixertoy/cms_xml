<?php
namespace Pure\Page\Blocks;

use Pure\Abstracts\AbstractBlock;

class Explorer extends AbstractBlock
{
	public function getMenuItems()
	{
		$result = array();
		$name = "Pure\Models\Page";
		$pages = $this->getHelper()->findAll( $name );
		foreach( $pages as $page ) if( $page->getPublic() ) $result[] = $page;
		return $result;
	}
	
	public function getItemLabel( $item )
	{
		return $item->getPost()->getTitle();
	}
	
	public function getItemTitle( $item )
	{
		return $item->getPost()->getDescription();
	}
	
	public function getItemLink( $item )
	{
		return $item->getPost()->getRoute();
	}
	
}