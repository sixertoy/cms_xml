<?php
/**
 * PureMVC PHP Basic Demo
 * PureMVC Port to PHP originally translated by Asbjørn Sloth Tønnesen
 *
 * @author Omar Gonzalez :: omar@almerblank.com
 * @author Hasan Otuome :: hasan@almerblank.com 
 * 
 * Created on Sep 24, 2008
 * PureMVC - Copyright(c) 2006-2008 Futurescale, Inc., Some rights reserved.
 * Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
 */
use Bluemagic\BootStrap;
use Bluemagic\Core\Debug;
use Bluemagic\Core\Connecter;
use Bluemagic\Core\ClassLoader;
use Bluemagic\Utils\StringUtils;
use Bluemagic\Loaders\ConfigLoader;
use Bluemagic\Loaders\DBConfigLoader;

use Pure\Patterns\StartupFacade;

/**
 * La facade PureMVC est cree sur la methode _initFacade
 * 
 * @author Rose
 *
 */
class Pure extends BootStrap 
{
//{region Variables
	//static private $_instance;
//}region Variables
//{region Static Public Methods
	/*
	static public function getInstance( $main=null )
	{
		if( !isset( self::$_instance ) ) self::$_instance = new Pure( $main );
		return self::$_instance;
	}
	*/

	/**
	 *  
	 * @see \Bluemagic\BootStrap::__initIncludePath()
	 */
	protected function __initIncludePath()
	{
		parent::__initIncludePath();
		$paths = array( get_include_path() );
		$paths[] = APPLICATION_PATH."/code/core/";
		$paths[] = APPLICATION_PATH."/code/local/";
		// @TODO definir dans une variable pour un acces depuis le DoctrineRunner
		$paths[] = APPLICATION_PATH."/repository/core/";
		$paths[] = APPLICATION_PATH."/repository/local/";
		set_include_path( implode( PS, $paths ) );
	}
	
	/**
	 * Chargement des package par defauts de l'application
	 * 
	 * @return \Bluemagic\Core\ClassLoader
	 */
	protected function __initCoreAutoloader()
	{
		parent::__initCoreAutoloader();
		$coreAutoloader = new ClassLoader( "PureMVC" );
		$coreAutoloader->register();
		$coreAutoloader = new ClassLoader( "Doctrine" );
		$coreAutoloader->register();
		$coreAutoloader = new ClassLoader( "Pure" );
		$coreAutoloader->register();
		return $coreAutoloader;
	}
	
//}region Static Public Methods
//{region Public Methods

	/**
	 * Lancement de l'application
	 * 
	 */
	public function run()
	{
		$this->getFacade()->initialize( $this->getConfig() );
		return true;
	}
	
//}region Public Methods
//{region Init Methods

	/**
	 * Initialization du loader de configuration
	 */
	protected function _initConfig()
	{
		$files = array( "pure", "application", "smarty" );
		$config_loader = new ConfigLoader();
		$config = $config_loader->load( $files );
		return $config;
	}
	
	/**
	 * Initialisation du moteur de template
	 */
	protected function _initFacade()
	{
		$facade = StartupFacade::getInstance();
		return $facade;
	}
	
//}region Init Methods
//{region Define Methods

	/*
	protected function _defineDoctrine()
	{
		$config = $this->getConfig()->getConfigByName( "doctrine" );
		return true;
	}
	*/

	/**
	 * Definition de debugger, Definition des logs PHP
	 */
	protected function _defineDebug()
	{
		$debug = $this->getConfig()->getConfigByName( "debug" );
		Debug::setLogErrors( $debug->logs );
		Debug::setDisplaysErrors( $debug->displays );
		Debug::setTraceLevel( $debug->debug_level_max );
		$debug = $this->getConfig()->getConfigByName( "environnement" );
		Debug::setEnvironnement( $debug->production );
		return true;
	}
	
//}region Define Methods
}
?>