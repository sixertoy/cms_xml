<?php
namespace Pure\Patterns\Commands;

use Pure\Patterns\StartupFacade;
use Pure\Patterns\Proxies\RequestProxy;

use PureMVC\Interfaces\INotification;
use PureMVC\Patterns\Command\SimpleCommand;

/**
 * Redirige la vue vers l'URL construite dans le body de la commande
 * 
 * @version 1.0
 * @author Matthieu Lassalvy
 * @link http://www.76oner.com/wiki/index.php/Pure_Project#RedirectionCommand
 * @link http://www.webrankinfo.com/outils/faq_8_61.htm
 */
class RedirectToInstallCommand extends SimpleCommand
{
	public function execute( INotification $note )
	{
		$request_proxy = $this->facade->retrieveProxy( RequestProxy::NAME );
		$link = $request_proxy->getInstallLink();
		$this->sendNotification( StartupFacade::REDIRECT_TO, $link );
		exit();
	}
}