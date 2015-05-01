<?php
namespace Bluemagic;

require( "Core/Debug.php" );
require( "Core/Object.php" );
require( "Core/ClassLoader.php" );

use Exception;

use Bluemagic\Core\Debug;
use Bluemagic\Core\Object;
use Bluemagic\Core\ClassLoader;

class BootStrap extends Object
{
//{region Variables
	protected $_rootPath;	
	protected $_entryPoint;	
	// Static
	static protected $_includes = array();
//}region Variables
//{region Public Methods
	public function __construct( $main )
	{	
		$this->_entryPoint = $main;
		$this->_rootPath = dirname( $this->_entryPoint );
		$this->__initIncludePath();
		$this->__initCoreAutoloader();
		$this->__init(); 
	}
	public function getRootPath(){ return $this->_rootPath; }
	public function getEntryPoint(){ return $this->_entryPoint; }
	
//}region Public Methods
//{region Private Methods

	protected function __initIncludePath()
	{
		$paths = array( get_include_path() );
		
		$paths[] = LIBRARY_PATH;
		set_include_path( implode( PS, $paths ) );
	}
	
	/**
	 * Chargement des package par defauts de l'application
	 * 
	 * @return \Bluemagic\Core\ClassLoader
	 */
	protected function __initCoreAutoloader()
	{
		$coreAutoloader = new ClassLoader( "Bluemagic" );
		$coreAutoloader->register();
		return $coreAutoloader;
	}

	/**
	 * Initialization type F.I.F.O. 
	 * Lance les methodes d'initialization de l'application
	 */
	private function __init()
	{
		$inits = array();
		$defines = array();
		$class_methods = get_class_methods( $this );
		foreach( $class_methods as $method )
		{
			// _init
			$subject = substr( $method, 0, 6 );
			$init_pattern = "/^_init[A-Z]/";
			$match = preg_match( $init_pattern, $subject );
			if( $match ) $inits[] = $method;
			// _define
			$subject = substr( $method, 0, 8 );
			$define_pattern = "/^_define[A-Z]/";
			$match = preg_match( $define_pattern, $subject );
			if( $match ) $defines[] = $method;
		}
		// Appel des _init
		foreach( $inits as $method )
		{
			$value = call_user_func( array( $this, $method ) );
			$key = substr( $method, 5 );
			call_user_func_array( array( $this, "set".$key ), array( $value ) );
		}
		// Appel des _define
		foreach( $defines as $method ) call_user_func( array( $this, $method ) );
		return $this;	
	}
//}region Private Methods
//{region Public Static Methods
//}region Public Static Methods	
}
