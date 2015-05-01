<?php
namespace Bluemagic\Abstracts;

class AbstractSession
{
	
	protected $_connecter;
	protected $_locked = 5;
	protected $_session_time = 7200; // Valable 2H
//	protected $sessionTime = 172800; // Valable 2J
	
	function __construct( $connecter )
	{
		$this->_connecter = $connecter;
		$this->_initSessionHandler();
	}
	/**
	 * Sauvergarde des sessions en base
	 * 
	 */
	protected function _initSessionHandler()
	{
 		ini_set( "session.gc_divisor", 1 );
		ini_set( "session.gc_probability", 1 );
		ini_set( "session.save_handler", "user" );
		
		$service = $this;
		session_set_save_handler
		(
			array( $service, "openSession" ),
			array( $service, "closeSession" ),
			array( $service, "readSession"  ),
			array( $service, "writeSession" ),
			array( $service, "destroySession" ),
			array( $service, "checkSessionValidity" )
		);
		return true;
	}
	/**
	 * 
	 * 
	 */
	public function openSession( $path, $name )
	{
//		session_regenerate_id();
		$this->connect = mysql_connect( $this->host, $this->user, $this->password, 1 );
		$bdd = mysql_select_db( $this->dba, $this->connect );
		return $bdd;
	}
	/**
	 * 
	 * 
	 */
	public function closeSession()
	{
		mysql_close( $this->connect );
		return true;
	}
	/**
	 * 
	 * 
	 */
	public function readSession( $sid )
	{
		$sid = mysql_real_escape_string( $sid, $this->connect );
		$sql = "SELECT sid FROM sessions WHERE sid = '$sid' ";
		$query = mysql_query( $sql, $this->connect ) or exit( mysql_error() );
		$data = mysql_fetch_array( $query );
		if( empty( $data ) ) return false;
		else return $data[ 'sid' ];
	}
	/**
	 * 
	 * 
	 */
	public function writeSession( $sid, $data )
	{
		$date = time();
		$expire = intval( $date + $this->_session_time );
		//
		$data = mysql_real_escape_string( $data, $this->connect );
		$sql = "SELECT COUNT( sid ) AS count FROM sessions WHERE sid = '$sid' ";
		$query = mysql_query( $sql, $this->connect ) or exit( mysql_error() );
		$result = mysql_fetch_array( $query );
		if( empty( $result[ "count" ] ) )
		{
			$sql = "INSERT INTO sessions SET sid= '$sid', attempt = '0', created = '$date', modified = '$expire', locked = '$this->_locked' ";	
		}else $sql = "UPDATE sessions SET modified = '$expire' WHERE sid = '$sid' ";
		//
		$query = mysql_query( $sql, $this->connect ) or exit( mysql_error() );
		return $query;
	}
	/**
	 * 
	 * 
	 */
	public function checkSessionValidity()
	{
		$date = time();
		$sql = "DELETE FROM sessions WHERE modified < ".$date;
		$query = mysql_query( $sql, $this->connect ) or exit( mysql_error() );
		return $query;
	}
	/**
	 * 
	 */
	public function destroySession( $pSessionId )
	{
		$sql = "DELETE FROM sessions WHERE sid = '$pSessionId' ";
		$query = mysql_query( $sql, $this->connect ) or exit( mysql_error() );
		return $query;
	}
	
}