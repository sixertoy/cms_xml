<?php
namespace Pure\Patterns\Commands;

use Pure\Patterns\StartupFacade;
use Pure\Patterns\Proxies\CacheProxy;
use Pure\Patterns\Proxies\LayoutProxy;
use Pure\Patterns\Proxies\FallbackProxy;
use Pure\Patterns\Proxies\RequestProxy;

use PureMVC\Interfaces\INotification;
use PureMVC\Patterns\Command\SimpleCommand;

/**
 * 
 * 
 * @version 0.1
 * @author Matthieu Lassalvy
 *
 */
class PrepareLayoutCommand extends SimpleCommand
{
	/**
	 * Gestion du layout de l'application
	 * Creation et Mise en cache
	 * 
	 * @see \PureMVC\Patterns\Command\SimpleCommand::execute()
	 */
	public function execute( INotification $pNote )
	{	
		$cache_proxy = $this->facade->retrieveProxy( CacheProxy::NAME );
		$layout_proxy = $this->facade->retrieveProxy( LayoutProxy::NAME );
		$layout_proxy->prepareLoader();
		$loaded = $layout_proxy->loadPageLayout();
		
		var_dump( $loaded );
		
		if( $loaded )
		{
			
			$app_layout_name = $layout_proxy->getApplicationLayoutName();
				
			$is_cached = $cache_proxy->existsInCache( $app_layout_name );
			$is_cached = false; // @TODO
			if( !$is_cached )
			{
				$loaded = $layout_proxy->prepareLayouts();
				if( !$loaded )
				{
					$this->sendNotification( StartupFacade::REDIRECT_TO_ERROR );
					exit();
				}
				
				$app_layout = $layout_proxy->prepareApplicationLayout();
				$cache_proxy->cacheLayout( $app_layout, $app_layout_name );
				
			}
			else
			{
				// @TODO gestion du cache
			}
		}
	}
}