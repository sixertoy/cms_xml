<?php
namespace Pure\Patterns\Commands;

use Bluemagic\Core\Debug;

use Pure\Patterns\StartupFacade;
use Pure\Patterns\Proxies\RequestProxy;
use Pure\Patterns\Proxies\ConnecterProxy;
use Pure\Patterns\Proxies\ApplicationProxy;

use PureMVC\Interfaces\INotification;
use PureMVC\Patterns\Command\SimpleCommand;
use Pure\Patterns\Proxies\ConfigProxy;

/**
 * Determine qu'elle vue sera executee durant/avant l'intialisation de l'application 
 * 
 * @version 0.1
 * @author Matthieu Lassalvy
 * @link http://www.76oner.com/wiki/index.php/Pure_Project#PrepareApplicationCommand
 */
class PrepareApplicationCommand extends SimpleCommand
{
	/**
	 * Si ce n'est pas une vue d'erreur
	 * Teste si le fichier encrypte des donnes de BDD existe
	 * Et que l'URL n'est pas correcte
	 * Redirige vers la vue de base
	 * Si l'application n'est pas prete et que ce n'est pas la vue d'installation
	 * 
	 * (non-PHPdoc)
	 * @see \PureMVC\Patterns\Command\SimpleCommand::execute()
	 */
	public function execute( INotification $pNotification )
	{

		$conf_proxy = $this->facade->retrieveProxy( ConfigProxy::NAME );
		$conn_proxy = $this->facade->retrieveProxy( ConnecterProxy::NAME );
		$request_proxy = $this->facade->retrieveProxy( RequestProxy::NAME );
		
		// Active le debug AJAX
		$request_proxy->debugRequest();
		Debug::useAjax( $request_proxy->isAsynchronous() );
				
		// Si l'URL n'est pas valide (pas de vue)
		// Redirige vers la page d'acceuil
		if( !$request_proxy->isValidURL() )
		{
			$this->sendNotification( StartupFacade::REDIRECT_TO_HOME, $link );
			exit();
		}
		
		// Verifie s'il s'agit d'un layout d'erreur
		if( !$request_proxy->isErrorLayout() )
		{
			if( $this->facade->isApplicationReady() )
			{				
				// Lance la preparation du connecter a la BDD
				$app_config = $conf_proxy->getApplicationConfig();
				$db_prepared = $conn_proxy->prepareConnecter( $app_config->is_production, $app_config->apikey );
				// Si il s'agit d'une vue necessitant un login user
				// On prepare le session en BDD
// 				if( $request_proxy->isRestrictedView() ) $conn_proxy->prepareSession();
				
			}
			// Si l'application n'est pas prete on lance l'installation
			elseif( !$request_proxy->isInstallView() )
			{
				$this->sendNotification( StartupFacade::REDIRECT_TO_INSTALL );
				exit();
			}
			
		}
	}
}