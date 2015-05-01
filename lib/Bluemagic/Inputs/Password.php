<?php
namespace Bluemagic\Inputs;

use Bluemagic\Inputs\Input;

/** 
 * http://www.w3schools.com/TAGS/tag_input.asp
 */
class Password extends Input
{
	protected $_need_validation;
	/**
	 * 
	 * @param		$pId string - Id de l'input
	 * @return		AbstractInput
	 */
	function __construct( $id, $type )
	{
		parent::__construct( $id, $type );
		$this->_need_validation = false;
	}
	
	/**
	 * Le champs de formulaire sera duplique dans le template Smarty
	 * Afin de verifier que le password correspond
	 */
	public function getNeedValidation()
	{
		return $this->_need_validation;
	}
		
	public function setNeedValidation( $pValue )
	{
		$this->_need_validation = $pValue;
	}
}