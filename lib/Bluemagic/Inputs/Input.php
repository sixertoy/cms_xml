<?php
namespace Bluemagic\Inputs;

/** 
 * http://www.w3schools.com/TAGS/tag_input.asp
 */

class Input
{
	protected $_id;
	protected $_type;
	protected $_label;
	protected $_value;
	protected $_classes;
	protected $_options;
	protected $_checked;
	protected $_disabled;
	protected $_readOnly;
	protected $_required;
	protected $_description;
	protected $_need_validation; // 
	/**
	 * 
	 * @param		$pId string - Id de l'input
	 * @return		AbstractInput
	 */
	function __construct( $pId, $pType )
	{
		$this->_id = $pId;
		$this->_label = "";
		$this->_value = "";
		$this->_type = $pType;
		$this->_checked = false;
		$this->_required = false;
		$this->_disabled = false;
		$this->_classes = array();
		$this->_readOnly  = false;
		$this->_options = array();
	}
	
	public function checked()
	{
		$this->_checked = true;
	}
	
	public function getChecked()
	{
		return $this->_checked;
	}
	
	/**
	 * @param array $pValues
	 */
	public function getOptions()
	{
		return $this->_options;
	}
	
	public function setOptions( $pValues )
	{
		$this->_options = $pValues;
	}
	
	public function disabled()
	{
		$this->_disabled = true;
	}
	
	public function isDisabled()
	{
		return $this->_disabled;
	}
	
	public function readOnly()
	{
		$this->_readOnly = true;
	}
	
	public function isReadOnly()
	{
		return $this->_readOnly;
	}
	
//{region Helpers
	public function isRequired()
	{
		return $this->_required;
	}
	
	public function setRequired( $pValue )
	{
		$this->_required = $pValue;
	}
	
	public function getClasses()
	{
		return implode( " ", $this->_classes );
	}
	
	public function addClass( $pValue )
	{
		array_push( $this->_classes, $pValue );
	}

//}region Helpers
//{region Getters & Setters
	public function getId(){ return $this->_id; }	
	public function getType(){ return $this->_type; }
	public function setType( $pValue ){ $this->_type = $pValue; }	
	public function getLabel(){ return $this->_label; }
	public function setLabel( $pValue ){ $this->_label = $pValue; }
	public function getValue(){ return $this->_value; }
	public function setValue( $pValue ){ $this->_value = $pValue; }
	public function getDescription(){ return $this->_description; }
	public function setDescription( $pValue ){ $this->_description = $pValue; }
//}region Getters & Setters	
//{region Private Methods
//}region Private Methods
}