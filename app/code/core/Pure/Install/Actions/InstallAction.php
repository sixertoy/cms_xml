<?php
namespace Pure\Install\Actions;

use Bluemagic\Core\Debug;

use Pure\Patterns\Proxies\ApplicationProxy;

use Pure\Patterns\Proxies\ConnecterProxy;

use Pure\Core\DoctrineRun;
use Bluemagic\Core\Notification;
use Bluemagic\Helpers\DomHelper;

use Pure\Interfaces\IAction;
use Pure\Abstracts\AbstractAction;
use Pure\Abstracts\AbstractAsynchronous;

class InstallAction extends AbstractAction implements IAction
{
	
	public function execute( $request )
	{
		
		if( $this->isAjaxSuccess( $request ) )
		{
			$this->getController()->gotoNextAction( "complete" );
		}
		// @TODO redirection vers une vue d'erreur
		else
		{
// 			var_dump( $request );
		}
		
	}
	
}