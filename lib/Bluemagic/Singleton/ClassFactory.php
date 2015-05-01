<?php
namespace Bluemagic\Singleton;

use Exception;

use Pure\Core\ApplicationConstants;

use ReflectionClass;
use ReflectionMethod;

use Bluemagic\Core\Debug;

class ClassFactory 
{
	
	protected $_className = "ClassFactory";
	protected $_packageName = "Bluemagic\Singleton";	
	
	/**
	 * Cree l'instance d'une classe 
	 * 
	 * @param string $class_name
	 * @param array $args
	 * @return object
	 */
	static public function newInstance( $class_name, $args )
	{
		$message = "Creation dynamique de l'instance de $class_name";
		Debug::trace( $message, Debug::DEBUG );
		$object = new ReflectionClass( $class_name );
		$instance = $object->newInstanceArgs( $args );
		return $instance;
	}
	
	/**
	 * Execute une methode d'une classe cree dynamiquement
	 * 
	 * @param object $instance
	 * @param string $action
	 * @param array $args
	 * @return mixed
	 */
	static public function execute( $instance, $action, $args=null )
	{
		// Verifie si la classe possede la methode
		// Sinon on fait un appel sur le call
		$class_name = $instance->getFullClassName();
		$has_action = self::hasMethod( $instance, $action );
		if( !$has_action )
		{
		    $message = "La methode '$action' est appelle via '__call' sur l'instance de '$class_name'";
		    Debug::trace( $message, Debug::WARN );
		}
		else
		{
		    $message = "La methode $action est appelle sur l'instance de $class_name";
		    Debug::trace( $message, Debug::DEBUG );
		}
		// On appelle la function sur l'instance
		$object = new ReflectionMethod( $class_name, $action );
		if( is_null( $args ) ) $args = array();
// 		$args = ( $has_action ) ? $args : array( $action, $args );
		return $object->invokeArgs( $instance, $args );
	}
	
	/**
	 * Verifie si l'action est contenu dans la classe
	 * 
	 * @param string $class_name
	 * @param string $action
	 * @return boolean
	 */
	static public function hasMethod( $class_name, $method )
	{
	    $classReflector = new ReflectionClass( $class_name );
	    $has_action = $classReflector->hasMethod( $method );
	    return $has_action;
	}
}