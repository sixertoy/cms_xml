<?php
namespace Pure\Patterns\Proxies;

use Bluemagic\Loaders\FileLoader;

use Bluemagic\Core\CoreConstants;

use PureMVC\Patterns\Proxy\Proxy;

/**
 * Construit un tableau de fallback pour un type de fichier demande
 * 
 * @version 0.1
 * @author Matthieu Lassalvy
 */
class FallbackProxy extends Proxy
{

	private $_views;
	private $_loader;
	
    const FALLBACK_JOKER = "%%fallback%%";
	const SCRIPTS_PATH = "skin/js/%%fallback%%/";
	const IMAGES_PATH = "skin/img/%%fallback%%/";
	const STYLESHEETS_PATH = "skin/css/%%fallback%%/";
	const LAYOUTS_PATH = "app/design/%%fallback%%/layouts/";
	const TEMPLATES_PATH = "app/design/%%fallback%%/templates/";
		
	const NAME = "FallbackProxy";
	const FULL_NAME = "Pure\Proxies\FallbackProxy";
	
	public function __construct( $name, $data )
	{		
		parent::__construct( $name, $data );
		$this->_loader = new FileLoader();
		$this->_views = $this->getData();
	}
	
	/**
	 * 
	 * @param unknown $file
	 * @param unknown $path
	 * @return Ambigous <boolean, string>
	 */
	public function getRessource( $file, $path )
	{
		$this->_loader->setFallBackPath( $path );
		return $this->_loader->getFilePath( $file );
	}
	
	/**
	 * Retourne un chemin vers un fichier
	 * 
	 * @param string $view_name
	 * @param string $path
	 * @return Ambigous <multitype:mixed , multitype:>
	 */
	public function getFallbackPath( $view_name, $path )
	{
		if( $view_name )
		{
			$extends =  $this->_views->{ $view_name }->extends;
			$fallbacks = array( str_replace( self::FALLBACK_JOKER, $view_name, $path ) );
			if( !empty( $extends ) )
			{
				$result = $this->getFallbackPath( $extends, $path );
				if( !empty( $result ) ) $fallbacks = array_merge( $fallbacks, $result );
			}
			return $fallbacks;
		}
		return false;
	}
}