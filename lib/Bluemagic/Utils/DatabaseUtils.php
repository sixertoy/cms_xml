<?php
namespace Bluemagic\Utils;

use PDO;
use PDOException;

use Bluemagic\Core\Debug;

class DatabaseUtils
{
	
	const MYSQL_DRIVER = "mysql";
	const PDO_DRIVER = "pdo_mysql";
	
	/**
	 * Teste si l'extension PDO peut utiliser les drivers mysql
	 */
	static public function isDriverAvailable( $driver="mysql" )
	{
		foreach( PDO::getAvailableDrivers() as $items ) if( $items == $driver ) return true;
		return false;
	}
	
	/**
	 * Verifie une connection sur une BDD MySQL
	 * 
	 * @param string $host
	 * @param string $name
	 * @param string $user
	 * @param string $password
	 * 
	 * @return boolean
	 */
	static public function isDatabaseAvailable( $host, $name, $user, $password )
	{
		try
		{
			$pdo_options = array
			(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
			);
			$dns = "mysql:host=".$host.";dbname=".$name;
			$conn = new PDO( $dns, $user, $password, $pdo_options );
			$message = "Test de connection a la BDD :: ".$name." OK";
			Debug::trace( $message, Debug::DEBUG );
			return true;
		}
		catch( PDOException $e )
		{
			$message = "Test de connection a la BDD :: ".$name." NOK";
			Debug::trace( $message, Debug::ERROR );
			return false;
		}
	}
}