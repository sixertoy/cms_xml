<?php
namespace Pure\Core;

use Smarty;

use Bluemagic\Core\Debug;
use Bluemagic\Core\CoreConstants;

use Pure\Abstracts\AbstractBlock;
use Pure\Patterns\Proxies\ConfigProxy;
use Pure\Patterns\Proxies\FallbackProxy;
use Pure\Patterns\Mediators\ViewMediator;

/**
 * Root Block de l'application
 * Fallback des methodes abstraites des AbstractBlock
 * @author Rose
 *
 */
class ApplicationRootBlock extends AbstractBlock
{
	
    private $_smarty;
    private $_application;
    
    const NAME = "Pure\Core\ApplicationRootBlock";
	
	public function __construct()
	{
		$this->_id = "root";
		$this->_parent = false;
		$this->_is_debuggable = false;
		$this->_body_classes = array();
		$this->_type = "pure_application_root_block";
	}
	
	/**
	 * 
	 * @param unknown $parent
	 * @return \Pure\Core\ApplicationView
	 */
	public function setParent( $parent )
	{
		$this->_parent = $parent;
		return $this;
	}
	
	/**
	 * @TODO|PURE A supprimer puisque present dans le applicationfacade
	 * @return \Smarty
	 */
	public function getSmarty()
	{
		return $this->_smarty;
	}
	
	/**
	 * 
	 */
	public function prepareSmarty( $smarty_config )
	{
		$this->_smarty = new Smarty();
		$this->_smarty->cache_dir = $smarty_config->cache;
		$this->_smarty->debugging = $smarty_config->debug;
		$this->_smarty->config_dir = $smarty_config->configs;
		$this->_smarty->compile_dir =  $smarty_config->compile;
		$this->_smarty->template_dir = $smarty_config->templates;
		$this->_smarty->left_delimiter = $smarty_config->tags->open;
		$this->_smarty->right_delimiter = $smarty_config->tags->close;
	}

	/**
	 * Ajoute les classes sur le body
	 // Affecte le layout utiliser en classe de body
	 // Prefixe la classe par template
	 // Le prefixe page etant reserve pour la vue
	 // 		$view = $this->getHelper()->getCurrentView();
	 // Ajoute une classe CSS correspondante a l'action en cours sur la vue
	 // 		$action = $this->getHelper()->getCurrentAction();
	 // 		$this->_addBodyClass( ( "page-".$view."-".$action ) );
	 *
	 * Les classe indiquant de layout
	 * Les classe indiquant la vue+l'action
	 */
	/**
	 * (non-PHPdoc)
	 * @see \Pure\Abstracts\AbstractBlock::setTemplate()
	 */
	public function setTemplate( $name )
	{
		$this->_template = $name;
		$css_body_class = "template/".$this->_template;
		$css_body_class = str_replace( "/", "-", $css_body_class );
		$this->_addBodyClass( $css_body_class );
		return $this;
	}
	
	public function getTemplateFile( $file )
	{
		$file .= CoreConstants::TEMPLATE_FILE_EXTENSION;
		return $this->_getFilePath( $file, FallbackProxy::TEMPLATES_PATH );
	}
	
	public function getStylesheetFile( $file )
	{
		return $this->_getFilePath( $file, FallbackProxy::STYLESHEETS_PATH );
	}
	
	private function _getFilePath( $file, $type )
	{
		$view = $this->_parent->getCurrentView();
		$proxy = $this->_parent->retrieveProxy( FallbackProxy::NAME );
		$path = $proxy->getFallbackPath( $view, $type );
		return $proxy->getRessource( $file, $path );
	}


	public function getScriptFile( $file )
	{
		return $this->_getFilePath( $file, FallbackProxy::SCRIPTS_PATH );
	}
	/**
	 * Function appelle depuis le Layout XML
	 * 
	 * @param string $classes_string
	 */
	public function setBodyClass( $classes_string )
	{
		return $this->_addBodyClass( $classes_string );
	}
	 
	/**
	 * Function appelle depuis le template PHTML
	 * 
	 * @return string
	 */
	public function getBodyClass()
	{
		return implode( " ", $this->_body_classes );
	}
	
	/**
	 * Ajoute des classes CSS au Body HTML
	 * 
	 * @param string $classes_string
	 */
	public function _addBodyClass( $classes_string )
	{
		// Si les valeurs passees en params sont multiples separees par ","
		if( strpos( $classes_string, "," ) )
		{
			$classes = explode( ",", $classes_string );
// 			$classes = array_map( "trim", $classes ); // @TODO verifier le debug
			$this->_body_classes = array_merge( $classes, $this->_body_classes );
		}
		else array_push( $this->_body_classes, $classes_string );
		return $this;
	}
	
//{region Redirection
//}region Redirection
}