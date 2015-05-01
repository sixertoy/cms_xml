<?php
namespace Pure\Patterns\Commands\Macros;

/**
 * PureMVC PHP Basic Demo
 * @author Omar Gonzalez :: omar@almerblank.com
 * @author Hasan Otuome :: hasan@almerblank.com 
 * 
 * Created on Sep 24, 2008
 * PureMVC - Copyright(c) 2006-2008 Futurescale, Inc., Some rights reserved.
 * Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
 */
use Pure;

use Pure\Core\ApplicationRootBlock;

use PureMVC\Interfaces\INotification;
use PureMVC\Patterns\Command\MacroCommand;
use PureMVC\Patterns\Command\SimpleCommand;

// Proxies
use Pure\Patterns\Proxies\CacheProxy;
use Pure\Patterns\Proxies\ConfigProxy;
use Pure\Patterns\Proxies\LayoutProxy;
use Pure\Patterns\Proxies\RequestProxy;
use Pure\Patterns\Proxies\FallbackProxy;
use Pure\Patterns\Proxies\ConnecterProxy;
use Pure\Patterns\Proxies\ControllerProxy;

// Mediators
use Pure\Patterns\Mediators\BlocksMediator;

class InitializeMediators extends SimpleCommand
{
	public function execute( INotification $notification )
	{
		$root_block = new ApplicationRootBlock();
		$blocks_mediator = new BlocksMediator( BlocksMediator::NAME, $root_block );
		$this->facade->registerMediator( $blocks_mediator );
	}
}

class InitializeProxies extends SimpleCommand
{
	public function execute( INotification $notification )
	{
		// ConfigProxy
		// Responsable de la distribution de la configuration aux autres proxy
		$config_proxy = new ConfigProxy( ConfigProxy::NAME, $notification->getBody() );
		$this->facade->registerProxy( $config_proxy );
		
		// RequestProxy
		// Parse les requetes HTTP
		$entities_proxy = new ConnecterProxy( ConnecterProxy::NAME, false );
		$this->facade->registerProxy( $entities_proxy );
		
		// FallbackProxy
		// Responsable des chemins de fichiers
		$fallback_proxy = new FallbackProxy( FallbackProxy::NAME, $config_proxy->getViews() );
		$this->facade->registerProxy( $fallback_proxy );

		// RequestProxy
		// Parse les requetes HTTP
		// Responsable des redirection de vue: Installation/Secured/Error
		$request_proxy = new RequestProxy( RequestProxy::NAME, $config_proxy->getRequestConfig() );
		$this->facade->registerProxy( $request_proxy );

		// CacheProxy
		// Responsable de la gestion du cahe pour les pages/templates/layouts
		$cache_proxy = new CacheProxy( CacheProxy::NAME, $config_proxy->getCacheConfig() );
		$this->facade->registerProxy( $cache_proxy );
		
		// LayoutProxy
		// Responsable de la construction des layouts
		$layout_proxy = new LayoutProxy( LayoutProxy::NAME, $config_proxy->getViews() );
		$this->facade->registerProxy( $layout_proxy );
		
		// ControllerProxy
		// Responsable de la gestion des controllers
		$controller_proxy = new ControllerProxy( ControllerProxy::NAME, $config_proxy->getViews() );
		$this->facade->registerProxy( $controller_proxy );
		
	}
}

/**
 * The <code>StartApplicationCommand</code> prepares the view first 
 * so that it is ready to display data when the model is done loading.
 */
class InitializeApplicationMacro extends MacroCommand
{
	/**
	 * The <code>initializeMacroCommand</code> is overridden to
	 * add references to instances of SimpleCommand that should
	 * be executed.
	 */
	protected function initializeMacroCommand()
	{
		$this->addSubCommand( "Pure\Patterns\Commands\Macros\InitializeProxies" );
		$this->addSubCommand( "Pure\Patterns\Commands\Macros\InitializeMediators" );
	}
}