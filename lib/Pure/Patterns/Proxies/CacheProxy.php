<?php
namespace Pure\Patterns\Proxies;

use Pure\Core\ApplicationConstants;

use PureMVC\Patterns\Proxy\Proxy;
use Pure\Core\PureConstants;

class CacheProxy extends Proxy
{

	private $_pages;
	private $_expire;
	private $_layouts;
	private $_templates;
	private $_use_cache;
		
	const NAME = "CacheProxy";
	const FULL_NAME = "Pure\Proxies\CacheProxy";
	
	public function __construct( $name, $data )
	{		
		parent::__construct( $name, $data );
	}
	
	public function use_cache(){ return $this->getData()->enabled; }
	
	/**
	 * 
	 * @param string $layout_name
	 * @return boolean
	 */
	public function existsInCache( $layout_name )
	{ 
		$request_proxy = $this->facade->retrieveProxy( RequestProxy::NAME );
		$is_ajax = $request_proxy->isAsynchronous();
		
		if( $this->use_cache() && !$is_ajax )
		{
			$filename = md5( $layout_name ).PureConstants::LAYOUT_FILE_EXTENSION;
			$filename = PureConstants::LAYOUTS_CACHE_PATH.$filename;
			return file_exists( $filename );
		}
		return false;
	}
	
	/**
	 * Mise en cache du layout
	 * 
	 * @param unknown $app_layout
	 * @param unknown $app_layout_name
	 * @return boolean
	 */
	public function cacheLayout( $app_layout, $app_layout_name )
	{
		if( $this->use_cache() )
		{
			$filename = md5( $app_layout_name ).PureConstants::LAYOUT_FILE_EXTENSION;
			$filename = PureConstants::LAYOUTS_CACHE_PATH.$filename;
			$app_layout->getDocument()->preserverWhiteSpace = false;
			$app_layout->getDocument()->formatOuput = true;
			$app_layout->getDocument()->save( $filename );
			return true;
		}
		return false;
	}
	
	/**
	 * Sauvegarde un fichier de layout en cache
	 * @param string $pModule - Id de la page
	 */
	/*
	public function getCachePageUrl( $page )
	{
		$filename = md5( $page ).Constants::PAGE_FILE_EXTENSION;
		$filePath = Constants::PAGES_CACHE_PATH."/".$filename;
		return $filePath;
	}
	*/
	
	/**
	 * Sauvegarde un fichier de layout en cache
	 * @param string $pModule - Id du module
	 */
	/*
	public function getCacheLayoutFile( $name )
	{
		$filename = md5( $name ).self::LAYOUT_FILE_EXTENSION;
		$filePath = self::LAYOUTS_CACHE_PATH.$filename; 
		return $filePath;
	}
	*/
	
	/**
	 * Sauvegarde un fichier de template en cache
	 * @param string $pFile - Id du template
	 */
	/*
	public function getCacheTemplateUrl( $template )
	{
		$filename = md5( $template ).Constants::TEMPLATE_FILE_EXTENSION;
		$filePath = Constants::TEMPLATES_CACHE_PATH."/".$filename;
		return $filePath;
	}
	*/
}