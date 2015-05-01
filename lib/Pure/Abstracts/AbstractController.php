<?php
namespace Pure\Abstracts;


use Pure\Patterns\StartupFacade;

use Pure\Patterns\Proxies\ConnecterProxy;

use Pure\Patterns\Proxies\RequestProxy;

use Exception;

use Bluemagic\Core\Link;
use Bluemagic\Core\Debug;
use Bluemagic\Core\Object;
use Bluemagic\Core\Collection;
use Bluemagic\Utils\Normalizer;
use Bluemagic\Core\ClassLoader;
use Bluemagic\Core\Notification;
use Bluemagic\Singleton\ClassFactory;

use Pure\Core\AuthController;

class AbstractController
{

	private $_link;
	private $_form;
	private $_view;

	protected $_proxy;
	protected $_manager;

	protected $_set_data;
	protected $_entityName;
	protected $_map;
	protected $_notifications;
	
	protected $_className = "AbstractController";
	protected $_packageName = "Pure\Abstracts\AbstractController";
	
	/**
	 * @params $pCurrentView - Vue courante recue depuis l'AbstractBlock/ControllerMediator
	 */
	public function __construct( $proxy=null )
	{
		$this->_proxy = $proxy;
		$this->_set_data = array();
		$this->_map = false;
		$this->_notifications = array();
		$this->initializeActions();
// 		$this->_link = new Link( $this->getCurrentView(), $this->getCurrentLayout(), $this->getCurrentAction() );
	}
	
	/**
	 * Si la methode __setUp est redifinie par un enfant
	 * Elle doit obligatoirement appelle la methode _setUp du parent
	 * 
	 * @param boolean $is_ajax
	 * @param \Bluemagic\Core\Request
	 * 
	 * @return \Pure\Abstracts\AbstractController
	 */
	public function __setUp( $is_ajax, $request )
	{   
	    return $this;
	}
	
	/**
	 * 
	 * @param boolean $is_ajax
	 * @return \Pure\Abstracts\AbstractController
	 */
	public function __tearDown( $is_ajax, $request )
	{
	    return $this;
	}
	
	/*
	public function getLink()
	{
		$request_proxy = $this->getProxy()->getFacade()->retrieveProxy( RequestProxy::NAME );
		return $request_proxy->getCurrentLink();
	}
	*/
	
	/**
	 * Redirige la vue 
	 * @param \Bluemagic\Core\link $link
	 */
	/*
	public function redirectTo( $link )
	{
	    $name = StartupFacade::REDIRECT_TO;
        $this->getProxy()->sendNotification( $name, $link );
        return false; 
	}
	*/
	
	/**
	 * Verifie si l'action est contenue dans la map
	 * @return boolean
	 */
	public function isActionRegistered( $name=false )
	{
		if( $name && is_array( $this->_map ) ) return array_key_exists( $name, $this->_map );
		else return false;
	}
	
	/**
	 * Retourne si la vue contient des erreurs
	 * @return boolean
	 */
	public function hasError()
	{
		$notes = $this->getNotifications();
		return ( isset( $notes[  "error" ] ) && !empty( $notes[  "error" ] ) );	
	}
	
	/**
	 * Verifie si le controller est d'instance AuthController
	 * Vue necessitant un login/vue securisee 
	 * @return boolean
	 */
	public function isAuthController()
	{
		return ( $this instanceof AuthController );
	}
	
	/**
	 * Retourne le ControllerProxy
	 * @return \Pure\Patterns\Proxies\ControllerProxy
	 */
	public function getProxy()
	{
		return $this->_proxy;
	}
	
//{region IController Interface

	/**
	 * 
	 * @return string
	 */
	public function getEntityName()
	{
		return $this->_entityName;
	}
	
	public function setEntityName( $name )
	{
		$this->_entityName = $name;
		return $this;
	}
//}region IController Interface

	/**
	 * Retourne la vue courante
	 * 
	 * @return \Pure\Abstracts\AbstractBlock
	 */
	public function getView()
	{
		return $this->_view;
	}
	
	/**
	 * Affecte la vue courante
	 * @param \Pure\Abstracts\AbstractBlock $value
	 * @return \Pure\Abstracts\AbstractController
	 */
	public function setView( $value )
	{
		$this->_view = $value;
		return $this;
	}
	
	/**
	 * 
	 * @return \Bluemagic\Core\Link
	 */
	/*
	public function getLink()
	{
		var_dump( $this->_link );
		exit();
		return $this->_link;
	}
	*/
	
	/**
	 * 
	 * @param \Bluemagic\Abstracts\AbstractForm $value
	 * @return \Pure\Abstracts\AbstractController
	 */
	public function setForm( $value )
	{
		$this->_form = $value;
		return $this;
	}
	
	/**
	 * 
	 * @return \Bluemagic\Abstracts\AbstractForm
	 */
	public function getForm()
	{
		return $this->_form;
	}
	
	/**
	 * Ajout des actions du controller
	 * 
	 * @param string $name
	 * @param string $class_name
	 * @return \Pure\Abstracts\AbstractAction
	 */
	public function registerAction( $name, $class_name )
	{
		$this->_map[ $name ] = $class_name;
		return $this;
	}
	
	/**
	 * 
	 * @param string $name
	 * @return boolean
	 */
	public function retrieveAction( $name )
	{
	    $actions = $this->retrieveActions();
	    if( !empty( $actions ) )
	    {
		    if( $this->isActionRegistered( $name ) ) return $this->_map[ $name ];   
	    } 
		
	    $message = "L'action de controller '".$name."' n'est pas initialize";
		Debug::trace( $message, Debug::DEBUG );
		return false;
		
	}
	
	/**
	 * 
	 * @return Ambigous <boolean, string>
	 */
	public function retrieveActions()
	{
		return $this->_map;
	}
	
	/**
	 * Ajoute des message qui seront recuperes par la vue
	 */
	public function addNotification( $note, $level )
	{
		$note = new Notification( $note, $level );
		if( !isset( $this->_notifications[ $level ] ) ) $this->_notifications[ $level ] = array();
		array_push( $this->_notifications[ $level ], $note );
	}
	
	/**
	 * Retourne les notifications de la vue
	 * @return \Bluemagic\Core\Notification
	 */
	public function getNotifications()
	{
		return $this->_notifications;
	}
	
//{region Entities Repository

	public function getManager()
	{
		if( !isset( $this->_manager ) )
		{
			$connecter_proxy = $this->getProxy()->getFacade()->retrieveProxy( ConnecterProxy::NAME );
			$this->_manager = $connecter_proxy->getDoctrineRunner()->getEntityManager(); 
		}
		return $this->_manager;
	}

	/**
	 * 
	 * @param string $name
	 * @return boolean
	 */
	 protected function getRepository( $name=false )
	{
		if( !empty( $name ) ) return $this->getManager()->getRepository( $name );
		else return $this->getManager()->getRepository( $this->_entityName );
		return false;
	}

	/**
	 * 
	 * @param string $name
	 */
	public function findAll( $name=false )
	{
		return $this->getRepository( $name )->findAll();
	}
	
	/**
	 * 
	 * @param unknown $args
	 * @param string $name
	 * @return unknown
	 */
	public function findBy( $args, $name=false )
	{
	    $repository = $this->getRepository( $name );
	    $entity = $repository->findOneBy( $args );
		return $entity;
	}
	
	/**
	 * 
	 * @param unknown $id
	 * @param string $name
	 */
	public function find( $id, $name=false )
	{
		if( empty( $name ) ) $name = $this->getEntityName();
		return $this->getManager()->find( $name, $Id );
	}
//}region Entities Repository
	
    // Retourne le nom de la classe de l'objet
    public function getClassName()
    {
    	$exploded = explode( ClassLoader::CLASS_NAME_SPLITTER, $this->getFullClassName() );
    	return $exploded[ count( $exploded ) - 1 ];
    }
    
    // @TODO Retourne le nom et le namespace de la classe
    /**
     * 
     * @return string
     */
    public function getFullClassName()
    {
    	return get_class( $this );
    }
    
//{region __call Fallbacks
    /**
     * 
     * @param string $prop_name
     * @return boolean
     */
    public function hasProperty( $prop_name )
    {
    	return ( isset( $this->_set_data[ $prop_name ] ) );
    }
    
    /**
     * 
     * @param string $prop_name
     * @return boolean
     */
    public function getData( $prop_name )
    {
    	return ( isset( $this->_set_data[ $prop_name ] ) ? $this->_set_data[ $prop_name ] : false );
    }
    
    /**
     * 
     * @param string $method
     * @param array $args
     * @return boolean|\Pure\Abstracts\AbstractController|mixed
     */
	public function __call( $method, $args )
    {
    	if( substr( $method, 0, 3 ) === "set" )
    	{
    		$prop_name = substr( $method, 3 );
    		if( isset( $this->_set_data[ $prop_name ] ) )
    		{
	    		$message = "La propriete '$prop_name' existe deja sur le controller '".$this->getClassName()."' ";
				Debug::trace( $message, Debug::DEBUG );
				return false;
    		}
    		else $this->_set_data[ $prop_name ] = isset( $args[ 0 ] ) ? $args[ 0 ] : null;
    		return $this;
    	}
    	else
    	{
	    	$message = "AbstractController::__call( '$method' ) -> ControllerProxy";
			Debug::trace( $message, Debug::DEBUG );
	    	$param_arr = ( !is_array( $args ) ? ( ( is_null( $args ) || empty( $args ) || !isset( $args ) ) ? array() : array( $args ) ) : $args );
	    	return call_user_func_array( array( $this->_proxy, $method ), $param_arr );
    	}
    }
//}region __call Fallbacks
}