<?php
namespace Bluemagic\Core;

use DateTime;
use Bluemagic\Utils\DateUtils;

class DBSession
{
	
	protected $_connecter;
	protected $_locked = 5;
	const SESSION_MAXLIFETIME = 7200; // Valable 2H
//	protected $sessionTime = 172800; // Valable 2J
	
	const SESSIONS_TABLE_NAME = "pr_sessions";
	
	/**
	 * http://stackoverflow.com/questions/9451983/php-session-class-using-pdo-getting-errors
	 */
	function __construct( $pdo_connecter )
	{
		$this->_connecter = $pdo_connecter;
		$this->_initSessionHandler();
	}
	
	public function start()
	{
		session_start();   
	}
	
	public function __destruct()
    {
        session_write_close();
    }
    
	public function closeSession(){ return true; }
	public function openSession( $path, $name ){ return true; }
    
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
			array( $service, "garbageCollector" )
		);
		return true;
	}

    protected function _fetchSession( $sid )
    {	
    	$time = new DateTime( "NOW" );
    	$time = ( $time->getTimeStamp() - self::SESSION_MAXLIFETIME );
        $stmt = $this->_connecter->prepare( "SELECT sid, data FROM ".self::SESSIONS_TABLE_NAME." WHERE sid = :sid AND modified > :modified" );
        $stmt->execute( array( ":sid" => $sid, ":modified" =>$time ) );
        $sessions = $stmt->fetchAll();
        return empty( $sessions ) ? false : $sessions[ 0 ];
    }
	
	/**
	 * 
	 * 
	 */
	public function readSession( $sid )
	{
        $session = $this->_fetchSession( $sid );
	    return ( $session === false ) ? false : $session[ "data" ];
	}
	
	/**
	 * 
	 * 
	 */
	public function writeSession( $sid, $data=false )
	{
        $datetime = DateUtils::getDateTimeSQL( "NOW" );
	    $session = $this->_fetchSession( $sid );
        if( $session === false )
        {
            $stmt = $this->_connecter->prepare( "INSERT INTO ".self::SESSIONS_TABLE_NAME." ( sid, data, locked, attempt, created, modified ) VALUES ( :sid, :data, :locked, :attempt, :created, :modified )" );
        	$stmt->execute( array( ":sid"=>$sid, ":data"=>$data, ":created"=>$datetime, ":locked"=>"0", ":attempt"=>"0", ":modified"=>$datetime ) );
        }
        else
        {
            $stmt = $this->_connecter->prepare( "UPDATE ".self::SESSIONS_TABLE_NAME." SET data = :data, modified = :modified WHERE sid = :sid" );
        	$stmt->execute( array( ":sid"=>$sid, ":data"=>$data, ":modified"=>$datetime ) );
        }
	}
	
	/**
	 * 
	 * 
	 */
	public function garbageCollector()
	{	
    	$time = new DateTime( "NOW" );
    	$time = ( $time->getTimeStamp() - self::SESSION_MAXLIFETIME );
	    $stmt = $this->_connecter->prepare( "DELETE FROM ".self::SESSIONS_TABLE_NAME." WHERE modified < :modified" );
        $stmt->execute( array( ":modified"=>$time ) );
	}
	/**
	 * 
	 */
	public function destroySession( $sid )
	{
	    $stmt = $this->_connecter->prepare( "DELETE FROM ".self::SESSIONS_TABLE_NAME." WHERE sid = :sid" );
	    $stmt->execute( array( ":sid"=>$sid ) );
	}
	
}