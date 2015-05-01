<?php
namespace Pure\Core\Blocks;

use Pure\Abstracts\AbstractBlock;

class Error extends AbstractBlock
{
	
	private $_error_message;
	
	public function errorMessage( $value )
	{
		$this->_error_message = $value;
	}
	
	public function getErrorMessage()
	{
		return $this->_error_message;
	}
}
?>