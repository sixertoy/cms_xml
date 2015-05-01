<?php
namespace Bluemagic\Objects;

class Column
{
	private $_key;
	private $_type;
	private $_label;

	const LINK_TYPE = "link";
	const EMAIL_TYPE = "email";
	const ABSTRACT_TYPE = "abstract";
	const IDENTIFIER_TYPE = "identifier";
	
	/**
	 * 
	 * @param string $key
	 * @param string $label
	 */
	public function __construct( $key, $label, $type=false )
	{
		$this->_key = $key;
		$this->_label = $label;
		$this->_type = Column::ABSTRACT_TYPE;
		if( !empty( $type ) ) $this->_type = $type;
	}
	
	public function isIdentifier()
	{
		return ( $this->_type == self::IDENTIFIER_TYPE );
	}
	
	/**
	 * 
	 * @param string $type
	 */
	public function setType( $value )
	{
		$this->_type = $value;
		return $this;
	}

	public function getType()
	{
		return $this->_type;
	}
	
	/**
	 * 
	 * @param string $value
	 * @return \Bluemagic\Objects\Column
	 */
	public function setLabel( $value )
	{
		$this->_label = $value;
		return $this;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getLabel()
	{
		return $this->_label;
	}
	
	/**
	 * 
	 * @param string $value
	 * @return \Bluemagic\Objects\Column
	 */
	public function setKey( $value )
	{
		$this->_key = $value;
		return $this;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getKey()
	{
		return $this->_key;
	}
	
}