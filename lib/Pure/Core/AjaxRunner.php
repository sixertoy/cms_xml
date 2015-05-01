<?php
namespace Pure\Core;

class AjaxRunner
{
	
	private $_link;
	private $_handler;
	private $_fault_handler;
	private $_result_handler;
	
	public function __construct( $handler, $result_name=false, $fault_name=false )
	{
		$this->_handler = $handler;
		$this->_fault_handler = $result_name;
		$this->_result_handler = $fault_name;
	}
	
	/**
	 * 
	 * @param Bluemagic\Core\Link $link
	 */
	public function run( $link )
	{
		
		$this->_link = $link;
		$this->_link->useAjax();

		global $ajax_url;
		$ajax_url = "ajax.index.php".$link->get();
		
	}
	
	public function setFaultHandler( $function_name )
	{
		$this->_fault_handler = $function_name;
		return $this;
	}
	
	public function setResultHandler( $function_name )
	{
		$this->_result_handler = $function_name;
		return $this;
	}
}