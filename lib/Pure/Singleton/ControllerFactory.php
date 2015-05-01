<?php
namespace Pure\Singleton;

use Pure\Abstracts\AbstractAction;

use Bluemagic\Core\ClassLoader;

use ReflectionClass;

use Bluemagic\Core\Debug;

use Bluemagic\Singleton\ClassFactory;

class ControllerFactory extends ClassFactory
{
	
	const ACTION_SUFFIX = "Action";
	
	/**
	 * @TODO Verifier qu'il s'agit d'une intance de IController
	 * 
	 * @param \Pure\Abstracts\AbstractController $instance
	 * @param string $action
	 * @param \Pure\Patterns\ControllerProxy $proxy
	 * 
	 * @return string
	 */
	static public function hasAction( $instance, $action, $proxy )
	{
		$class_name = $instance->getFullClassName();
        $has_action = self::hasMethod( $class_name, self::getActionName( $action ) );
        
		if( $has_action ) return true;
		elseif( $instance->isActionRegistered( $action ) ) return true;
				
		$message = "La classe d'action '".$action."' n'existe pas pour le controller '".$class_name."'";
		Debug::trace( $message, Debug::ERROR );
		return false;
	}
	
	/**
	 * 
	 * @param \Pure\Abstracts\AbstractController $instance
	 * @param string $action
	 * @param array $args
	 * @return boolean
	 */
	static public function execute( $controller, $action, $args=null )
	{
	    if( $action instanceof AbstractAction )
            return call_user_func_array( array( $action, "execute" ), $args );
	    else
	        return call_user_func_array( array( $controller, $action ), $args );
	    return false;
	}

	/**
	 * Suffixe le nom de l'action
	 * 
	 * @param string $action
	 * @return string
	 */
	static public function getActionName( $action )
	{
		if( strpos( $action, "_" ) !== false )
		{
			$actions = explode( "_", $action );
			$actions[ 1 ] = ucfirst( $actions[ 1 ] );
			$action = implode( "", $actions ); 
		}
		return $action.self::ACTION_SUFFIX;
	}
		
}