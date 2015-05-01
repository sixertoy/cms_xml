<?php
namespace Pure\Objects;

use Bluemagic\Core\Link;

use Bluemagic\Core\Collection;

class MenuObject extends Link
{
	
	private $_icon;
	private $_label;
	private $_action;
	private $_childs;
	private $_layout;
	
	/**
	 * 
	 * @param string $label
	 * @param string $_layout
	 * @param string $action
	 */
	public function __construct( $label=false, $layout=false, $action=false )
	{
		$this->_label = $label;
		parent::__construct( false, $layout, $action );
	}
	
	/**
	 * 
	 * @param string $value
	 * @return \Pure\Objects\MenuObject
	 */
	public function setIcon( $value )
	{
		$this->_icon = $value;
		return $this;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getIcon()
	{
		if( isset( $this->_icon ) ) return $this->_icon;
		return false;
	}
	
	/**
	 * 
	 * @param \Bluemagic\Core\Collection $value
	 * @return \Pure\Objects\MenuObject
	 */
	public function setChilds( $value )
	{
		$this->_childs = $value;
		return $this;	
	}
	
	/**
	 * 
	 * @return \Bluemagic\Core\Collection
	 */
	public function getChilds()
	{
		return $this->_childs;
	}
	
	/**
	 * 
	 * @param \Pure\Objects\MenuObject $value
	 * @return \Pure\Objects\MenuObject
	 */
	public function addChild( $value )
	{
		if( !isset( $this->_childs ) ) $this->_childs = new Collection();
		$this->_childs->add( $value );
		return $this;	
	}
	
	/**
	 * 
	 * @param string $value
	 * @return \Pure\Objects\MenuObject
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
}