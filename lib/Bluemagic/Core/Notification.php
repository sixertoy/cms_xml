<?php
namespace Bluemagic\Core;

class Notification
{
	const ERROR = "error";
	const SUCCESS = "success";
	const WARNING = "warning";
	
	private $_note;
	private $_level;
	
	/**
	 * 
	 * @param String $note
	 * @param String $level
	 */
	public function __construct( $note, $level )
	{
		$this->_note = $note;
		$this->_level = $level;
	}
	
	public function getLevel()
	{
		return $this->_level;
	}
	
	public function getNote()
	{
		return $this->_note;
	}
	
	public function isError()
	{
		return ( $this->_level == self::ERROR );
	}
	
	public function isSuccess()
	{
		return ( $this->_level == self::SUCCESS );
	}
	
	public function isWarning()
	{
		return ( $this->_level == self::WARNING );
	}
	
	public function __toString()
	{
		return $this->getNote();
	}
	
}