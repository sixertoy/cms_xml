<?php
namespace Pure\Core\Blocks;

use Pure\Abstracts\AbstractBlock;

class Form extends AbstractBlock
{
	
	private $_form;
	
	/**
	 * 
	 * @param \Bluemagic\Abstracts\AbstractForm $value
	 */
	public function setForm( $value )
	{
		$this->_form = $value;
		return $this;
	}
	
	/**
	 * 
	 * @return \Bluemagic\Abstracts\AbstractForm
	 */
	public function getForm()
	{
		return $this->_form;
	}
	
}