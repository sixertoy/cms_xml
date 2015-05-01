<?php
namespace Pure\Patterns\Commands;

// use Pure\Patterns\Mediators\ViewMediator;

use Pure\Patterns\StartupFacade;
use Pure\Patterns\Proxies\RequestProxy;
use Pure\Patterns\Proxies\ControllerProxy;

use PureMVC\Interfaces\INotification;
use PureMVC\Patterns\Command\SimpleCommand;
use Pure\Patterns\Proxies\LayoutProxy;

class PrepareControllerCommand extends SimpleCommand
{
	/**
	 * Determine qu'elle action sera execute
	 * Durant le processus d'installation
	 */
	public function execute( INotification $pNotification )
	{
		
		$controller_proxy = $this->facade->retrieveProxy( ControllerProxy::NAME );
		$controller = $controller_proxy->initController();
		if( !$controller )
		{
			$this->sendNotification( StartupFacade::REDIRECT_TO_ERROR );
			exit();
		}

		$request_proxy = $this->facade->retrieveProxy( RequestProxy::NAME );
		$action = $request_proxy->getCurrentAction();
		if( !$action )
		{
			$layout_proxy = $this->facade->retrieveProxy( LayoutProxy::NAME );
			$action = $layout_proxy->getLayoutAction();
		}
		
		$has_action = $controller_proxy->initAction( $action );
		if( !$has_action )
		{
			$this->sendNotification( StartupFacade::REDIRECT_TO_ERROR );
			exit();
		}
		
	}	
}