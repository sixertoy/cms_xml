<?php
namespace Pure\Install\Actions;

use DOMDocument;

use Bluemagic\Core\Crypter;
use Bluemagic\Helpers\DomHelper;
use Bluemagic\Singleton\CookieFactory;

use Pure\Interfaces\IAction;
use Pure\Abstracts\AbstractAction;

use Pure\Patterns\Proxies\ConnecterProxy;
use Pure\Patterns\Proxies\ApplicationProxy;

class CompleteAction extends AbstractAction implements IAction
{
	
	
	/**
	 * A deplacer dans la vue de l'application
	 * Envoyer uniquement l'evenement de fin d'installation
	 */
	public function execute( $request, $args )
	{
		
		$app_proxy = $this->getController()->getProxy( ApplicationProxy::NAME );
		
		if( $request->isSubmitted() )
		{
		    $is_secured = !( file_exists( ApplicationProxy::INSTALL_FOLDER ) );
			if( $is_secured ) $this->getController()->gotoNextAction( "start" );
		}
	}
}