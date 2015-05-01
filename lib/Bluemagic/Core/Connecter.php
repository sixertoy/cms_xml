<?php
namespace Bluemagic\Core;

use PDO;
use stdClass;

class Connecter
{
	private $_dbobject;
	private $_is_prod_mode;
	
	/**
	 * 
	 * @param Bluemagic\Objects\DBObject $dbobject
	 * @param boolean $is_dev_mode
	 */
	function __construct( $dbobject=null )
	{ 
		$this->_dbobject = $dbobject;
		$this->_pdo_connecter = false;
	}
//{region Static Methods
//}region Static Methods
//{region Public Methods
	
	public function isProductionMode()
	{
		return $this->_is_prod_mode;
	}

	public function setProductionMode( $bool )
	{
		$this->_is_prod_mode = $bool;
		return $this;
	}
	
	public function setConfig( $dbobject )
	{
		$this->_dbobject = $dbobject;
		return $this;
	}
	
	public function getConfig()
	{
		if( is_null( $this->_dbobject ) ) return false;
		return $this->_dbobject;
	}

	public function getConnectionParams()
	{
		if( is_null( $this->_dbobject ) ) return false;
		return $this->_dbobject->toArray();
	}
	
	public function getPDOConnecter()
	{
		if( is_null( $this->_dbobject ) ) return false;
		if( !$this->_pdo_connecter )
		{
			$dns = "mysql:host=".$this->_dbobject->getDBHost().";dbname=".$this->_dbobject->getDBName();
			$this->_pdo_connecter = new PDO( $dns, $this->_dbobject->getDBUser(), $this->_dbobject->getDBPassword(), $this->_getConnectionOptions() );
		}	
		return $this->_pdo_connecter;
	}
	
	/**
	 * Verifie la connection a la base de donnees
	 */
	public function isDatabaseAvailable()
	{
		if( is_null( $this->_dbobject ) ) return false;
		try
		{
			$conn = $this->getPDOConnecter();
			$message = "Test de connection a la BDD :: ".$this->_dbobject->getDBName()." OK";
			Debug::trace( $message, Debug::DEBUG );
			return true;
		}
		catch( PDOException $e )
		{
			$message = "Test de connection a la BDD :: ".$this->_dbobject->getDBName()." NOK";
			Debug::trace( $message, Debug::ERROR );
			return false;
		}
	}
	
	public function isTableAvailable( $name )
	{
		$conn = $this->getPDOConnecter();
		if( !$conn ) return false;
		$stmt = $conn->prepare( "SELECT 1 FROM ".$name );
		try
		{
			$stmt->execute();
			return true;
		}
		catch( PDOException $e ){ return false; }
	}
	
//}region Public Methods
//{region Private Methods
	
	private function _getConnectionOptions()
	{
		$pdo_options = array
		(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
		);
		return $pdo_options;
	}
	
//}region Private Methods

}