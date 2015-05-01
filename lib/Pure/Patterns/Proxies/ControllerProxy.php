<?php
namespace Pure\Patterns\Proxies;

use Pure\Abstracts\AbstractAction;

use Bluemagic\Utils\StringUtils;

use Pure\Patterns\Mediators\ViewMediator;

use ReflectionMethod;

use Bluemagic\Core\Debug;
use Bluemagic\Utils\Normalizer;
use Bluemagic\Core\ClassLoader;
use Bluemagic\Helpers\DomHelper;
use Bluemagic\Singleton\ClassFactory;

use Pure\Blocks\Root;
use Pure\Core\AuthController;
use Pure\Singleton\ControllerFactory;
use Pure\Patterns\Proxies\RequestProxy;
use Pure\Patterns\Proxies\ConnecterProxy;

use PureMVC\Patterns\Proxy\Proxy;

class ControllerProxy extends Proxy
{
	
	private $_map;
	private $_class;
	private $_action;
	private $_is_ajax;
	private $_request;
	private $_controller;
	
	const CONTROLLER_SUFFIX = "Controller";
	
	const NAME = "ControllerProxy";
	const FULL_NAME = "Pure\Patterns\Proxies\ControllerProxy";
	
	/**
	 * Affecte le controller qui sera utilise pour la vue principale
	 * Si la classe du controller existe
	 * Cree l'instance du controller
	 * 
	 * @return boolean|object
	 */
	public function initController()
	{

		$request_proxy = $this->facade->retrieveProxy( RequestProxy::NAME );
		$is_secured = $request_proxy->isRestrictedView();

		$layout_proxy = $this->facade->retrieveProxy( LayoutProxy::NAME );
		$package = $layout_proxy->getLayoutPackage();
		$controller_name = $layout_proxy->getLayoutController();
		
		$underscored = $package.ClassLoader::UNDERSCORE_SPLITTER.$controller_name;		
		
		$this->_class = $this->_getControllerClassName( $underscored );
		$class_exists = ClassLoader::classExists( $this->_class );
		
		if( !$class_exists )
		{
			$message = "La classe du controller ".$this->_class." n'existe pas";
			Debug::trace( $message, Debug::FATAL );
			return false;
		}
		
		$id = Normalizer::__pointify( $this->_class );
		$this->_controller = $this->getControllerById( $id, array( $this ) );
		
		// Si la vue est securisee
		// On teste si le controller appelle est une instance du AuthController
		if( $is_secured && !$this->_controller->isAuthController() )
		{
			$message = "La classe du controller ".$this->_class." n'est pas une instance du Pure\Core\AuthController";
			Debug::trace( $message, Debug::WARN );
			return false;
		}
		return $this->_controller;
	}
	
	/**
	 * 
	 * @TODO rename setControllerAction
	 * 
	 * @param unknown $instance
	 * @param string $action_name
	 * @return boolean|unknown
	 */
	public function initAction( $action_name )
	{
	    // Verifie si la methode existe/registered
		 $has_action = ControllerFactory::hasAction( $this->getController(), $action_name, $this );
		 
		 if( $has_action )
		 {
		     $is_registered = $this->getController()->isActionRegistered( $action_name );
		     if( $is_registered )
		     {
		         $class_action = $this->getController()->retrieveAction( $action_name );
		         if( class_exists( $class_action ) )
		         {
                    $this->_action = ClassFactory::newInstance( $class_action, array( $this->getController() ) );
                    return true;
		         }  
		     }
		     else
		     {
                $this->_action = ControllerFactory::getActionName( $action_name );
                return true;
		     }
		 }
		 $message = "L'action <i>".$action_name."</i> est manquante sur l'instance ".$this->_class;
		 Debug::trace( $message, Debug::ERROR );
		 return false;
	}
	
	public function setView( $mediator )
	{
		$this->getController()->setView( $mediator );
		return $this;
	}


	public function getController(){ return $this->_controller; }

	/*
	public function getFacade()
	{
		return $this->facade;
	}
		
	public function getControllerClassName()
	{
	    return $this->_class;
	}
	public function getManager()
	{
	    $proxy = $this->facade->retrieveProxy( ConnecterProxy::NAME );
	    $manager = $proxy->getDoctrineRunner()->getEntityManager();
	    return $manager;
	}
	*/
	
	/**
	 * Retourne l'instance du controller dans la map
	 * Sinon cree un nouveau controller
	 * 
	 * @param string $class_name
	 * @param array $arguments
	 */
	public function getControllerById( $id, $args=null )
	{
		if( isset( $this->_map[ $id ] ) ) return $this->_map[ $id ];
		else
		{
			if( empty( $arguments ) ) $arguments = array();
			$class_name = Normalizer::__backslash( $id );
			$args = ( ( !is_array( $args ) ) ? ( ( is_null( $args ) ) ? array() : array( $args ) ) : $args );
			$instance = ClassFactory::newInstance( $class_name, $args );
			$this->_addControllerById( $instance, $id );
			return $instance;
		}
	}
	
	public function executeActions()
	{
		$request_proxy = $this->facade->retrieveProxy( RequestProxy::NAME );
		$is_ajax = $request_proxy->isAsynchronous();
		$request = $request_proxy->getCurrentRequest();
		
		$this->callSetup( $is_ajax, $request );
		$this->executeAction();
		$this->callTeardown();
		
		return $this;
	}
	
	/**
	 * 
	 * @param \Pure\Abstracts\AbstractController $instance
	 * @param array $args
	 * @param boolean $is_ajax
	 * @return \Pure\Patterns\Proxies\ControllerProxy
	 */
	public function callSetup( $is_ajax, $request )
	{   
	    $this->_is_ajax = $is_ajax;
	    $request = ( ( !is_array( $request ) ) ? ( ( is_null( $request ) ) ? array() : array( $request ) ) : $request );
	    $this->_request = $request;
	    
	    if( $this->_action instanceof AbstractAction ) $this->_action->__setUp( $this->_is_ajax, $this->_request );
		$this->_controller->__setUp(  $this->_is_ajax, $this->_request );
		return $this;
	}
	
	/**
	 * Le controller execute l'action __setUp et __tearDown
	 * 
	 * @TODO Verifier si le controller herite de la classe AbstractsController
	 * 
	 * @param array $arguments
	 */
	public function executeAction()
	{
		ControllerFactory::execute( $this->_controller, $this->_action, $this->_request );
		return true;
	}
	
	/**
	 * 
	 * @param \Pure\Abstracts\AbstractController $instance
	 * @return \Pure\Patterns\Proxies\ControllerProxy
	 */
	public function callTeardown()
	{	    
	    if( $this->_action instanceof AbstractAction ) $this->_action->__tearDown( $this->_is_ajax, $this->_request );
		$this->_controller->__tearDown(  $this->_is_ajax, $this->_request );
		return $this;
	}
	
	/**
	 * Ajoute un controller a la map
	 * 
	 * @param Pure\Core\AbstractController $instance
	 * @param string $id
	 */
	private function _addControllerById( $instance, $id )
	{
		$this->_map[ $id ] = $instance;
	}
	
	/**
	 * Retourne la classe du controlleur
	 * 
	 * @param string $underscored
	 * @return string
	 */
	private function _getControllerClassName( $underscored )
	{
		$names = explode( ClassLoader::UNDERSCORE_SPLITTER, $underscored );
		$names = array_map( "ucfirst", $names );
		$names = implode( ClassLoader::SLASH_SPLITTER, $names );
		$controller_class = $names.self::CONTROLLER_SUFFIX;
		return $controller_class;
	}

//{region __call Fallbacks
	public function __call( $method, $args )
    {
    	$message = "__call ControllerProxy( '$method' ) -> ApplicationFacade";
       	Debug::trace( $message, Debug::DEBUG );
       	$param_arr = ( !is_array( $args ) ? ( ( is_null( $args ) || empty( $args ) || !isset( $args ) ) ? array() : array( $args ) ) : $args );
       	if( method_exists( $this->facade, $method ) )
       	{
       		return call_user_func_array( array( $this->facade, $method ), $param_arr );
       	}	
		else
		{
			$message = "Appel d'un methode inexistante depuis un controller -> $method()";
			$message = Debug::trace( $message, Debug::WARN );
			return false;
		}
    }
//}region __call Fallbacks
}