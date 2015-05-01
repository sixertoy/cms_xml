<?php
namespace Pure\Patterns\Proxies;

use stdClass;

use Bluemagic\Core\Link;
use Bluemagic\Core\Object;
use Bluemagic\Core\Debug;
use Bluemagic\Core\Request;
use Bluemagic\Utils\ServerUtils;

use PureMVC\Patterns\Proxy\Proxy;

class RequestProxy extends Proxy
{	
	
	const NAME = "RequestProxy";
	const FULL_NAME = "Pure\Patterns\Proxies\RequestProxy";

	private $_request;
	private $_base_url;
	
	private $_cms_view;
	private $_home_view;
	private $_install_view;
	
	private $_current_link;
	
	private $_error_layout;

	private $_is_asynchronous;
	private $_restricted_views;
	private $_url_reserved_keys;
	
	const GET = "get";
	const VIEW = "view";
	const POST = "post";
	const ACTION = "action";
	const LAYOUT = "layout";
	const ASYNCHRONOUS = "async";
	
	/**
	 * 
	 * @param string $pName
	 * @param Bluemagic\Core\Helpers\RequestHelper $pData
	 */
	public function __construct( $name, $data )
	{
		
		parent::__construct( $name, $data );
		
		$this->_request = new Request();
		$this->_is_asynchronous = false;
		
		$this->_base_url = $data->base_url;
		
		$this->_cms_view = $data->cms_view;
		$this->_home_view = $data->home_view;
		$this->_install_view = $data->install_view;
		
		$this->_error_layout = $data->error_layout;
		
		$this->_restricted_views = $data->restricted_views;
		$this->_url_reserved_keys = array( "view", "layout", "action" );
		
		// Parse l'URL Actuelle pour definir le nom de la vue, layout, action
		$this->_current_link = $this->_parseCurrentURL();
		
	}
	
	public function debugRequest()
	{
		if( $this->isAsynchronous() )
		{
			$this->getCurrentRequest()->debug();
		}
		return $this;
	}

	/**
	 * Retourne les parametres de requetes actuel
	 * 
	 * @return \Bluemagic\Core\Request
	 */
	public function getCurrentRequest()
	{
		return $this->_request;
	}

	public function getCMSView(){ return $this->_cms_view; }
	public function getDefaultView(){ return $this->_home_view; }
	public function getInstallView(){ return $this->_install_view; }
	public function getErrorLayout(){ return $this->_error_layout; }
	
	/**
	 * Verifie si l'URL est complete
	 * @return boolean
	 */
	public function isValidURL()
	{
		$name = $this->getCurrentView();
		return ( !empty( $name ) && !is_null( $name ) && isset( $name ) );
	}

	/**
	 * Retourne l'URL de base 
	 */
	public function getBaseURL()
	{
		return $this->_base_url;
	}

	/**
	 * Recupere le nom de la vue actuelle sur l'URL
	 * @return string
	 */
	public function getCurrentView()
	{
		return $this->getCurrentLink()->getView();
	}
	
	/**
	 * Recupere le nom de l'action actuelle sur l'URL
	 * @return Ambigous <string, boolean>
	 */
	public function getCurrentAction()
	{
	    return $this->getCurrentLink()->getAction();
	}
	
	/**
	 * Recupere le nom de l'action actuelle sur l'URL
	 * @return Ambigous <string, boolean>
	 */
	public function getCurrentLayout()
	{
		return $this->getCurrentLink()->getLayout();
	}
	
	/**
	 * Retourne l'URL complete
	 * @return string
	 */
	public function getCurrentURL()
	{
		return $this->getCurrentRequest()->getCurrentURL();
	}
	
	/**
	 * Verifie si la requete est une requete AJAX
	 * L'URL est parsee pour verifier la presence de la variable "async"
	 * 
	 * @return boolean
	 */
	public function isAsynchronous()
	{
		return $this->_is_asynchronous;
	}
	
	/**
	 * Retourne le lien vers la page d'erreur
	 * @param string $action
	 * 
	 * @TODO passer en constante
	 */
	public function getErrorLink( $action=false )
	{
	    $link = $this->getLink( $this->getCurrentView(), $this->getErrorLayout(), $action );
	    if( !$action && $this->_is_asynchronous ) $link->setAction( "errorAsync" ); 
		return $link;
	}
	
	/**
	 * Construit un lien
	 * 
	 * @param string $view_name
	 * @param string $layout_name | false
	 * @param string $action_name | false
	 * 
	 * @return \Bluemagic\Core\Link
	 */
	public function getLink( $view_name, $layout_name=false, $action_name=false )
	{
		$link = new Link( $view_name );
		if( $layout_name ) $link->setLayout( $layout_name );
		if( $action_name ) $link->setAction( $action_name );
		return $link;
	}

	public function getCurrentLink()
	{
		return $this->_current_link;
	}
	
	public function getCMSLink()
	{
		return $this->getLink( $this->_cms_view );
	}
	
	public function getHomeLink()
	{
		return $this->getLink( $this->_home_view );
	}
	
	public function getInstallLink()
	{
		return $this->getLink( $this->_install_view );
	}
	
	public function isInstallView()
	{
		return ( $this->getCurrentView() == $this->getInstallView() );
	}
	
	public function isErrorLayout()
	{
		return ( $this->getCurrentLayout() == $this->getErrorLayout() );
	}
	
	public function isRestrictedView()
	{
		return in_array( $this->getCurrentView(), $this->_restricted_views );
	}
	
	/**
	 * Parse l'URL et construit
	 * Un objet de type Bluemagic\Core\Objects\Link
	 * 
	 * Definie la vue depuis l'URL
	 * Si aucune vue n'est definie on utilise le default_view du fichier .ini
	 * 
	 * Definie la layout
	 * Si le layout n'est pas defini dans l'URL on utilise le default_view du fichier .ini
	 * Le layout defini surcharge le layout requit de l'application 'page.xml' 
	 * 
	 * Definie l'action depuis l'URL
	 * L'action sera appelle par le controller
	 * Le controller est defini dans le layout de la vue
	 * 
	 * @return \Bluemagic\Core\Link
	 */
	private function _parseCurrentURL()
	{
	    // Set de la vue
		$link = new Link( $this->getDefaultView() );
		if( isset( $_GET[ self::VIEW ] ) )
		{
			$view = trim( $_GET[ self::VIEW ] );
		    if( !empty( $view ) )$link->setView( $view );
		} 
		
		// Verification du layout
		if( isset( $_GET[ self::LAYOUT ] ) )
		{
			$layout = trim( $_GET[ self::LAYOUT ] );
			if( !empty( $layout ) ) $link->setLayout( $layout );
		}
		
		// Verification de l'action
		if( isset( $_GET[ self::ACTION ] ) )
		{
			$action = trim( $_GET[ self::ACTION ] );
			if( !empty( $action ) ) $link->setAction( $action );
		}
	
		// verification de l'ajax
		if( isset( $_GET[ self::ASYNCHRONOUS ] ) )
		{
			$async = trim( $_GET[ self::ASYNCHRONOUS ] );
			if( ( (bool) $async ) )
			{
				$link->useAjax();
				$this->_is_asynchronous = true;   
			}
		}
		
		return $link;
	}
}