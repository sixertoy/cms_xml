<?php
namespace Pure\Core\Blocks;

use Pure\Abstracts\AbstractBlock;

class Content extends AbstractBlock
{
    private $_content;
	
	/**
	 * 
	 * @param ApplicationMediator $parent
	 * @param string $template
	 */
	public function __construct( $parent )
	{
		parent::__construct( $parent );
		$this->_content = "";
		$this->_use_template = false;
	}
    
	public function content( $value )
	{
	    $this->_content = $value;
	}
    
	/**
	 * Methode magique retournant la specificite
	 * La plus pertinente de du block
	 */
	public function __toString()
	{
	    return $this->_content;    
	}
}