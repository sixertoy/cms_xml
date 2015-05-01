<?php
namespace Pure\Core\Blocks;

use Pure\Abstracts\AbstractBlock;

class Menu extends AbstractBlock
{

	protected $_items;
	private $_current_layout;

	protected function __setUp()
	{
		$this->_current_layout = $this->getCurrentLayout();
		parent::__setUp();
	}

	public function getItems()
	{
		if( is_null( $this->_items ) ) return false;
		return $this->_items;
	}
	
	/**
	 * 
	 * @param \Bluemagic\Core\Link $link
	 */
	public function isCurrent( $link )
	{
		return ( $link->getLayout() === $this->_current_layout );
	}
	
}