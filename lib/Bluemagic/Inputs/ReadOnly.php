<?php
namespace Bluemagic\Inputs;

use Bluemagic\Inputs\Input;

/** 
 * http://www.w3schools.com/TAGS/tag_input.asp
 */
class ReadOnly extends Input
{
	
	/**
	 * 
	 * @param		$pId string - Id de l'input
	 * @return		AbstractInput
	 */
	function __construct( $id, $type )
	{
		parent::__construct( $id, $type );
	}
}