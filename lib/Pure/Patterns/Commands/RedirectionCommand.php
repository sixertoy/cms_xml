<?php
namespace Pure\Patterns\Commands;

use Bluemagic\Core\Debug;

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
class RedirectionCommand extends SimpleCommand
{
	public function execute( INotification $note )
	{
		$link = $note->getBody();
		
		$request_proxy = $this->facade->retrieveProxy( RequestProxy::NAME );
		
		$current_url = $request_proxy->getCurrentRequest()->getCurrentURL();
		$redirection_url = $request_proxy->getBaseURL()."index.php".$link->get();
		
		$message = "Redirection de '$current_url' vers '$redirection_url' ";
		Debug::trace( $message, Debug::INFO );
		
        /*
		echo '<HTML><HEAD>';
		echo '<META HTTP-EQUIV="Refresh" Content="0;URL='. htmlspecialchars( $url ) .'">';
		echo '<META HTTP-EQUIV="Location" Content="'. htmlspecialchars( $url ) .'">';
		echo '</HEAD><BODY></BODY></HTML>';
        */
		
		header( "Location:".$redirection_url, true, "302" ); // Gerer les status de redirection
		exit();
	}
}