<?php
namespace Bluemagic\Objects;

class DBObject
{
	
	private $_dbuser;
	private $_dbhost;
	private $_dbname;
	private $_dbdriver;
	private $_dbpassword;
	
	function __construct( $dbhost, $dbname, $dbuser, $dbpassword, $dbdriver="pdo_mysql" )
	{ 
		$this->_dbuser = $dbuser;
		$this->_dbhost = $dbhost;
		$this->_dbname = $dbname;
		$this->_dbdriver = $dbdriver;
		$this->_dbpassword = $dbpassword;
	}
	
	public function getDBDriver()
	{
		return $this->_dbdriver;
	}
	
	public function getDBUser()
	{
		return $this->_dbuser;
	}
	
	public function getDBHost()
	{
		return $this->_dbhost;
	}
	
	public function getDBName()
	{
		return $this->_dbname;
	}
	
	public function getDBPassword()
	{
		return $this->_dbpassword;
	}
	
	/**
	 * Les parametres sont dans l'ordre
	 * Pour l'initialisation de Doctrine
	 */
	public function toArray()
	{
		$array = array
		(
			"host" => $this->_dbhost,
			"user" => $this->_dbuser,
			"driver" => $this->_dbdriver,
			"dbname" => $this->_dbname,
			"password" => $this->_dbpassword
		);
		return $array;
	}
	
	public function _toString()
	{
		
	}
	
}