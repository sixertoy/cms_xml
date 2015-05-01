<?php

require_once "../etc/kernel/core.kernel_config.php";
require_once LIBRARY_PATH.DS."Bluemagic/BootStrap.php";

use Bluemagic\BootStrap;
use Bluemagic\Core\Debug;
use Bluemagic\Core\ClassLoader;
use Bluemagic\Iterators\FileIterator;
use Bluemagic\PHPUnit\TestClassFactory;
use Bluemagic\PHPUnit\HTMLResultPrinter;

use PHPUnit\TextUI\TestRunner;
use PHPUnit\Framework\TestSuite;


/**
 * 
 * @author Matthieu Lassalvy
 * 
 * @link http://www.phpunit.de/manual/current/en/writing-tests-for-phpunit.html
 * @link https://github.com/sebastianbergmann
 * @link http://www.blog-nouvelles-technologies.fr/archives/6600/introduction-aux-tests-unitaires-en-php-avec-phpunit/
 */
class PHPUnitRunner extends BootStrap
{
	
	public function run( $classes )
	{	
		ob_start();
		$suite = new PHPUnit_Framework_TestSuite();		
		foreach( $classes as $name )
		{
			// @TODO|PURE erreur sous linux lamp classique
			$slashed_name = $name;
			$slashed_name = str_replace( "/", "\\", $slashed_name );
			$reflection = new ReflectionClass( $slashed_name );	
			$suite->addTestSuite( $reflection );
		}
		$result = PHPUnit_TextUI_TestRunner::run( $suite );
		ob_clean();
		
		$printer = new HTMLResultPrinter();

		$printer->projectName( "Pure" );
		$printer->toHTML( $result );
		
	}
	
	/**
	 * Configuration
	 * 
	 */
	function __construct( $main )
	{
		parent::__construct( $main );
	}
	
	/**
	 * Definition des fichiers de Debug
	 */
	public function _defineDebug()
	{
		$base = ROOT_PATH.DS."tests/debug".DS; 
		$file = $base."exceptions.log"; 
		Debug::setExceptionFile( $file );
		$file = $base."debug.log"; 
		Debug::setDebugFile( $file );
		$file = $base."errors.log"; 
		Debug::setErrorFile( $file );
		$file = $base."sql.log"; 
		Debug::setSQLFile( $file );
		Debug::setFatal( false );
		return true;
	}
	
	/**
	 * Inclusion des classes de tests
	 * 
	 */
	protected function __initIncludePath()
	{
		parent::__initIncludePath();
		$paths = array( get_include_path() );
		$paths[] = ROOT_PATH.DS."tests/lib/";
		$paths[] = ROOT_PATH.DS."tests/src/";
		set_include_path( implode( PS, $paths ) );
	}
	
	/**
	 * Chargement des ressources PHPUnit
	 * 
	 */
	protected function __initCoreAutoloader()
	{
		$coreAutoloader = new ClassLoader( "Doctrine" );
		$coreAutoloader->register();
		$coreAutoloader = new ClassLoader( "PureMVC" );
		$coreAutoloader->register();
		$coreAutoloader = new ClassLoader( "PHPUnit" );
		$coreAutoloader->register();
		$coreAutoloader = new ClassLoader( "Text" );
		$coreAutoloader->register();
		$coreAutoloader = new ClassLoader( "Pure" );
		$coreAutoloader->register();
		$coreAutoloader = new ClassLoader( "File" );
		$coreAutoloader->register();
		$coreAutoloader = new ClassLoader( "PHP" );
		$coreAutoloader->register();
		return parent::__initCoreAutoloader();
	}
	
}

// Init du runner
$runner = new PHPUnitRunner( dirname( dirname( __FILE__ ) ) );
// Recuperation des classes a tester dans le dossier lib
// @TODO|PURE le file iterator est dependant du runner
$filter = "Test.php";
$input = array(); 
$input[] = ROOT_PATH.DS."lib";
$classes = FileIterator::getClasses( $input, false, array( "Bluemagic", "Pure" ) );
$output = ROOT_PATH.DS."tests".DS."lib";
TestClassFactory::create( $classes, $output );
$classes = FileIterator::getClasses( $output, $filter, "" );
// Lancement des tests
$runner->run( $classes );
?>