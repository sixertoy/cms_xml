<?php
namespace Pure\Patterns\Mediators;

use Smarty;
use Exception;
use ReflectionClass;

use Bluemagic\Core\Link;
use Bluemagic\Core\Debug;
use Bluemagic\Utils\ArrayUtils;
use Bluemagic\Helpers\DomHelper;
use Bluemagic\Utils\StringUtils;
use Bluemagic\Loaders\FileLoader;
use Bluemagic\Core\CoreConstants;

use Pure\Patterns\StartupFacade;

use Pure\Patterns\Proxies\RequestProxy;
use Pure\Patterns\Proxies\FallbackProxy;
use Pure\Patterns\Proxies\ControllerProxy;
use Pure\Patterns\Proxies\ApplicationProxy;

use PureMVC\Interfaces\INotification;
use PureMVC\Patterns\Mediator\Mediator;
use Pure\Patterns\Proxies\ConfigProxy;
use Pure\Patterns\Proxies\LayoutProxy;
use Pure\Core\PureConstants;

/**
 * Retourne le template pour la vue en cours
 * @TODO l'introspection sur le noeuds block retourne aussi les enfants
 * @TODO la recursivite n'est pas prise en compte
 * @TODO cache file debug
 * @TODO mettre les ids dans des tableaux identifier par les parents pour eviter les doublons
 * @TODO gestion des erreurs sur les doublons
 * @TODO gestion des doublons
 */
class BlocksMediator extends Mediator
{
	
	private $_root_node;
	private $_blocks_map;
	private $_root_template;
	
	const NAME = "BlocksMediator";
	const FULL_NAME = "Pure\Mediators\BlocksMediator";
//{region Public Methods

	public function __construct( $mediatorName, $viewComponent )
	{
		parent::__construct( $mediatorName, $viewComponent );
		$this->getViewComponent()->setParent( $this );
		$config_proxy = $this->facade->retrieveProxy( ConfigProxy::NAME );
		$this->getViewComponent()->prepareSmarty( $config_proxy->getSmartyconfig() );
	}
	
	/**
	 * 
	 * @param \Pure\Core\Root $block
	 */
	public function output()
	{
        ob_start();
		$this->getViewComponent()->render();
		$output = ob_get_contents();
		ob_end_clean();
		print( $output );
		return $this;
	}
	
	/**
	 * Construction de la vue
	 * 
	 * @param \Pure\Abstracts\AbstractLayout $layout
	 */
	public function prepareView()
	{
		$layout_proxy = $this->facade->retrieveProxy( LayoutProxy::NAME );
		$layout = $layout_proxy->getApplicationLayout();
		
		$this->_root_node = $layout->getBlockById( PureConstants::ROOT_NODE_ID );
		$this->_root_template = DomHelper::getNodeAttr( $this->_root_node, "template" );
		$this->getViewComponent()->setTemplate( $this->_root_template );
		$this->_blocks_map = $this->getViewComponent()->parseChilds( $this->_root_node->childNodes );
		return $this;
	}
	
	/**
	 * Recupere un block par son ID
	 * 
	 * @param unknown $block_id
	 * @param string $blocks
	 * @return unknown
	 */
	public function getBlockById( $block_id, $blocks=false )
	{
		$id = strtok( $block_id, "." );
		$block = $this->_blocks_map[ $id ];
		while( ( $id = strtok( "." ) ) !== false )
		{
			$childs = $block->getChilds();
			$block = $childs[ $id ];
		}
		return $block;
	}
	
//}region Public Methods
//{region Private Methods
    	
//}region private Methods
//{region __call Fallbacks


	/**
	 * Les methodes appellees depuis les templates phtml
	 * Remontent sur ApplicationFacade
	 *
	 * @param string $method
	 * @param array $args
	 * @return mixed
	 */
	public function __call( $method, $args )
	{
		/*
    	$message = "Appel d'un methode inexistante sur un block, $method";
        $message = Debug::trace( $message, Debug::WARN );
        return false;
        */
    	$message = "__call BlocksMediator( '$method' ) -> ApplicationFacade";
       	Debug::trace( $message, Debug::DEBUG );
       	$param_arr = ( !is_array( $args ) ? ( ( is_null( $args ) || empty( $args ) || !isset( $args ) ) ? array() : array( $args ) ) : $args );
       	if( method_exists( $this->facade, $method ) )
       		return call_user_func_array( array( $this->facade, $method ), $param_arr );
		else
		{
			$message = "Appel d'un methode inexistante depuis un template, $method";
			$message = Debug::trace( $message, Debug::WARN );
			return false;
		}
	}
	
//}region __call Fallbacks
}