<?php
namespace Pure\Patterns\Proxies;

use Bluemagic\Helpers\DomHelper;

use Pure\Abstracts\AbstractLayout;

use Bluemagic\Core\Debug;
use Bluemagic\Loaders\FileLoader;
use Bluemagic\Core\CoreConstants;

use Pure\Core\PureConstants;
use PureMVC\Patterns\Proxy\Proxy;

class LayoutProxy extends Proxy
{
	private $_loader;
	private $_action;
	private $_package;
	private $_root_node;
	private $_page_layout;
	private $_module_name;
	private $_fallback_views;
	private $_override_layout;
	private $_current_view_name;
	private $_default_layout_file;
	private $_default_action_layout_name;
	private $_application_layout_name;
	
	const NAME = "LayoutProxy";
	const FULL_NAME = "Pure\Patterns\Proxies\LayoutProxy";

	/**
	 * Prepare le chargeur des layouts
	 * @return \Pure\Patterns\Proxies\LayoutProxy
	 */
	public function prepareLoader()
	{
		$request_proxy = $this->facade->retrieveProxy( RequestProxy::NAME );
		$view_name = $request_proxy->getCurrentView();
		$fallback_proxy = $this->facade->retrieveProxy( FallbackProxy::NAME );
		$fallback_path = $fallback_proxy->getFallbackPath( $view_name, FallbackProxy::LAYOUTS_PATH );
		$this->_loader = new FileLoader( $fallback_path );
		return $this;
	}
	
	/**
	 * Charge le layout principal de la page - page.xml
	 * @return Ambigous <\Pure\Patterns\Proxies\Pure\Core\Layout, boolean, \Pure\Abstracts\AbstractLayout>
	 */
	public function loadPageLayout()
	{
		$this->_page_layout = $this->_loadLayoutByName( PureConstants::DEFAULT_LAYOUT_NAME );
		$this->_controller = $this->_page_layout->getDefaultController();
		return $this->_page_layout;
	}
	
	/**
	 * Charge le 'default' layout
	 * Charge le 'controller' layout
	 * Recupere la classe du controller par defaut
	 * Recupere l'action par defaut
	 * Definie le nom du module pour la surcharge
	 */
	public function prepareLayouts()
	{
		$request_proxy = $this->facade->retrieveProxy( RequestProxy::NAME );
		$action_name = $request_proxy->getCurrentAction();
		
		// Charge le 'controller' layout
		$this->_override_layout = $this->_loadLayoutByName( $this->getLayoutController() );
		if( !$this->getOverrideLayout() ) return false;
		
		$def = $this->_override_layout->getDefaultController();
		if( $def ) $this->_controller = $this->_override_layout->getDefaultController();
		
		// Recupere l'action par defaut
		$this->_action = $this->getOverrideLayout()->getDefaultAction();
		if( $action_name ) $this->_action = $action_name;
		
		// Definie le nom du module pour la surcharge
		// @TODO Verifier si le noeud du module est dans le XML/Layout
		$this->_module_name = $this->getLayoutController().CoreConstants::UNDERSCORE.$this->getLayoutAction();
		
		// Recupere la classe du controller par defaut
		$this->_package = $this->getOverrideLayout()->getControllerPackage();
		
		return true;
	}
	
	/**
	 * Prepare le layout de l'application
	 * Add, Update, Remove du layout par defaut
	 * 
	 * Cree le layout qui sera utilise par l'application est mis en cache
	 * Recupere le noeud par defaut
	 * Le charge dans un nouveau Layout
	 * Met a jour le layout avec le layout de la vue est son module d'action
	 * @return \Pure\Abstracts\AbstractLayout
	 */
	public function prepareApplicationLayout()
	{
		$request_proxy = $this->facade->retrieveProxy( RequestProxy::NAME );
		$is_ajax = $request_proxy->isAsynchronous();
		
		$this->_application_layout = new AbstractLayout( "application_layout" );
		$node = $this->getPageLayout()->getNodesByName( PureConstants::LAYOUT_DEFAULT_NODE_NAME )->item( 0 );
		$this->getApplicationLayout()->loadNode( $node );
		$this->getApplicationLayout()->updateLayout( $this->getOverrideLayout(), PureConstants::LAYOUT_DEFAULT_NODE_NAME );
		if( !$is_ajax ) $this->getApplicationLayout()->updateLayoutWithView( $this->getOverrideLayout(), $this->getLayoutModuleName() );
		return $this->getApplicationLayout();
	}
	
	/**
	 * Retourne le nom du layout de l'application
	 * @return string
	 */
	public function getApplicationLayoutName()
	{
		$request_proxy = $this->facade->retrieveProxy( RequestProxy::NAME );
		$view_name = $request_proxy->getCurrentView();
		$layout_name = $request_proxy->getCurrentLayout();
		$action_name = $request_proxy->getCurrentAction();
		
		$this->_application_layout_name = $view_name;
		$this->_application_layout_name .= CoreConstants::UNDERSCORE;
		
		if( $layout_name )  $this->_controller = $layout_name;
		$this->_application_layout_name .= $this->getLayoutController();

		$this->_application_layout_name .= CoreConstants::UNDERSCORE;
		
		if( !$action_name ) $this->_application_layout_name .= PureConstants::LAYOUT_DEFAULT_NODE_NAME;
		else $this->_application_layout_name .= $action_name;
		
		return $this->_application_layout_name;
	}
	
	/**
	 * Creation du block Root
	 * 
	 * @param Pure\Core\Layout $layout
	 */
	/*
	public function prepareTemplate( $layout )
	{
		$this->_root_node = $layout->getBlockById( self::ROOT_NODE_ID );
		$template = DomHelper::getNodeAttr( $this->_root_node, "template" );
		return $template;
	}
	*/

	public function getRootNode(){ return $this->_root_node; }
	public function getLayoutAction(){ return $this->_action; }
	public function getLayoutPackage(){ return $this->_package; }
	public function getLayoutController(){ return $this->_controller; }
	public function getLayoutModuleName(){ return $this->_module_name; }

	public function getPageLayout(){ return $this->_page_layout; }
	public function getOverrideLayout(){ return $this->_override_layout; }
	public function getApplicationLayout(){ return $this->_application_layout; }
	
	/**
	 * Charge un layout par son nom
	 * 
	 * @return Pure\Core\Layout
	 */
	private function _loadLayoutByName( $layout_name )
	{
		$filename = $layout_name.PureConstants::LAYOUT_FILE_EXTENSION;
		$file_path = $this->_loader->getFilePath( $filename );
		if( !$file_path )
		{
			$message = "Impossible de charger le fichier de layout '$layout_name'";
			Debug::trace( $message, Debug::ERROR );
			return false;
		}
		$layout = new AbstractLayout( $layout_name );
		$layout->loadLayoutFile( $file_path );
		return $layout;
	}	
}