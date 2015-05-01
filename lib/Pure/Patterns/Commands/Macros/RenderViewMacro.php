<?php
namespace Pure\Patterns\Commands\Macros;

use PureMVC\Patterns\Command\MacroCommand;

use Bluemagic\Core\Debug;

use Pure\Patterns\Proxies\LayoutProxy;
use Pure\Patterns\Proxies\RequestProxy;
use Pure\Patterns\Proxies\FallbackProxy;
use Pure\Patterns\Proxies\ControllerProxy;
use Pure\Patterns\Mediators\BlocksMediator;

use PureMVC\Interfaces\INotification;
use PureMVC\Patterns\Command\SimpleCommand;

class Output extends SimpleCommand
{
	
	public function execute( INotification $note )
	{
		
		$view = $this->facade->retrieveMediator( BlocksMediator::NAME );
		$view->prepareView();
		
		$controller_proxy = $this->facade->retrieveProxy( ControllerProxy::NAME );
		$controller_proxy->executeActions();
		
		$view->output();
		
	}
	
}

class Ajax extends SimpleCommand
{
	
	public function execute( INotification $note )
	{
		$controller_proxy = $this->facade->retrieveProxy( ControllerProxy::NAME );
		$controller_proxy->executeActions();
	}
}

class RenderViewMacro extends MacroCommand
{
	protected function initializeMacroCommand()
	{
		$view_mediator = $this->facade->retrieveMediator( BlocksMediator::NAME );
		$controller_proxy = $this->facade->retrieveProxy( ControllerProxy::NAME );
		$controller_proxy->setView( $view_mediator );
		
		$request_proxy = $this->facade->retrieveProxy( RequestProxy::NAME );
		$command = ( $request_proxy->isAsynchronous() ) ? "Ajax" : "Output";
		$command = "Pure\Patterns\Commands\Macros\\".$command; 
		$this->addSubCommand( $command );
	}
	
}