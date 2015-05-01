<?php
namespace Pure\Core\Blocks;

use Bluemagic\Core\Debug;

use Pure\Abstracts\AbstractBlock;

class Debugger extends AbstractBlock
{	
	function __construct( $parent )
	{
		parent::__construct( $parent );
		$this->_is_debuggable = false;
	}
	
	/**
	 * Recupere les types des messages sur la classe Bluemagic\Core\Debug
	 * 
	 * @return multitype:string
	 */
    public function getTypes()
    {
    	return Debug::getTypes();
   	}
    
   	/**
   	 * Recupere les messages stockes par le debugger
   	 * 
   	 * @return multitype:
   	 */
    public function getMessages()
    {
    	return Debug::getMessages();
    }
}