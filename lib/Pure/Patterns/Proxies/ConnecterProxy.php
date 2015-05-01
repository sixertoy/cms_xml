<?php
namespace Pure\Patterns\Proxies;

use Pure\Core\DoctrineRun;

use PureMVC\Patterns\Proxy\Proxy;

use Bluemagic\Core\DBSession;
use Bluemagic\Core\Connecter;
use Bluemagic\Loaders\DBConfigLoader;
use Pure\Core\PureConstants;

class ConnecterProxy extends Proxy
{
	
	private $_loader;
	private $_connecter;
	private $_session_runner;
	private $_doctrine_runner;
	
	const NAME = "ConnecterProxy";
	const FULL_NAME = "Pure\Proxies\ConnecterProxy";
	
	public function __construct( $proxyName, $data=null )
	{
		parent::__construct( $proxyName, $data=null );
	}
	
	/**
	 * Preparation du connecter a la base de donnees
	 * Chargement du fichier de configuration
	 * 
	 * @return boolean
	 */
	public function prepareConnecter( $is_production, $api_key=false )
	{
		$temp_bd_file = PureConstants::DATABASE_TEMP_FILE;
		$secured_bd_file = PureConstants::DATABASE_SECURED_FILE;
		
		if( $api_key )
		{
			$this->_loader = new DBConfigLoader();
			$is_secured = file_exists( $secured_bd_file );
			
			$loaded = false;
			
			if( $is_secured )
			{
				$loaded = $this->_loader->load( $secured_bd_file, $api_key );
			}
			elseif( file_exists( $temp_bd_file ) )
			{
				$loaded = $this->_loader->loadXML( $temp_bd_file );
			}
			
			if( $loaded )
			{
				$this->_connecter = new Connecter( $this->_loader->getConfig() );
				$this->_connecter->setProductionMode( $is_production );
				$this->_doctrine_runner = new DoctrineRun( $this->getConnectionParams(), $is_production );
				$this->_session_runner = new DBSession( $this->getConnecter()->getPDOConnecter() );
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * 
	 * @return boolean
	 */
	public function isConnected()
	{
		$session = $this->getSession();
 		return ( isset( $session[ "connected" ] ) && !is_null( $session[ "connected" ] ) );
	}
	
	public function getSession()
	{
		return $_SESSION;
	}
	
	/**
	 * 
	 * @param unknown $pdo_connecter
	 */
	public function prepareSession()
	{
	 	$pdo_connecter = $this->getConnecter()->getPDOConnecter();
	    $this->_session_runner = new DBSession( $pdo_connecter, self::SESSIONS_TABLE_NAME );
	    return $this;
	}
	
	/**
	 * 
	 * @return \Bluemagic\Core\Connecter
	 */
	public function getConnecter()
	{
	    return $this->_connecter;
	}
	
	/**
	 * Recupere les parametres de connexions
	 * 
	 * @return boolean
	 */
	public function getConnectionParams()
	{
	    return $this->getConnecter()->getConnectionParams();
	}
	
	public function getDoctrineRunner()
	{
		if( !isset( $this->_doctrine_runner ) ) return false;
		return $this->_doctrine_runner;
	}
	
	public function getSessionRunner()
	{
		if( !isset( $this->_session_runner ) ) return false;
	    return $this->_session_runner;
	}
}