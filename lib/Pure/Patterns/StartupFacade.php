<?php
namespace Pure\Patterns;

/**
 * PureMVC PHP Basic Demo
 * @author Omar Gonzalez :: omar@almerblank.com
 * @author Hasan Otuome :: hasan@almerblank.com 
 * 
 * Created on Sep 24, 2008
 * PureMVC - Copyright(c) 2006-2008 Futurescale, Inc., Some rights reserved.
 * Your reuse is governed by the Creative Commons Attribution 3.0 Unported License
 */
use Pure\Core\ApplicationFacade;
use Bluemagic\Core\Debug;


/**
 * La facade gere le lancement des commandes d'installation et d'application
 * 
 * @author Rose
 *
 */
class StartupFacade extends ApplicationFacade
{
//{region Variables
	/**
	 * Commandes
	 * @link http://www.76oner.com/wiki/index.php/Pure_Project#Mapping_commande
	 */
	
	const RENDER_VIEW = "Pure_StartupFacade_RenderViewMacro"; // Affiche la vue
	const INIT_APPLICATION = "Pure_StartupFacade_InitializeApplicationMacro"; // Init des Proxies/Mediators

	const PREPARE_LAYOUTS = "Pure_StartupFacade_PrepareLayoutsCommand"; // Preparation du layout de l'application
	const PREPARE_APPLICATION = "Pure_StartupFacade_PrepareApplicationCommand.php"; // Lancement de l'installation
	const PREPARE_CONTROLLER = "Pure_StartupFacade_PrepareControllerCommand"; // Preparation du layout de l'application
	
	const REDIRECT_TO = "Pure_StartupFacade_RedirectionCommand"; // Redirection d'URL
	const REDIRECT_TO_HOME = "Pure_StartupFacade_RedirectToHomeCommand"; // Redirection d'URL
	const REDIRECT_TO_ERROR = "Pure_StartupFacade_RedirectToErrorCommand"; // Redirection d'URL
	const REDIRECT_TO_INSTALL = "Pure_StartupFacade_RedirectToInstallCommand"; // Redirection d'URL
//}region Variables

	/**
	 * 
	 * 
	 * @return \Pure\StartupFacade
	 */
	public function initialize( $config )
	{
		$this->sendNotification( StartupFacade::INIT_APPLICATION, $config );
		$this->sendNotification( StartupFacade::PREPARE_APPLICATION );
		return $this;	
	}
	
	/**
	 * Lance l'installation de l'application sur le serveur
	 * @return \Pure\StartupFacade
	 */
	public function startup()
	{
		$this->sendNotification( StartupFacade::PREPARE_LAYOUTS );
		$this->sendNotification( StartupFacade::PREPARE_CONTROLLER );
		$this->sendNotification( StartupFacade::RENDER_VIEW );
		return $this;
	}
	
	/**
	 * Mappings et Initialization des commandes
	 * 
	 * @see \PureMVC\Patterns\Facade\Facade::initializeController() 
	 */
	protected function initializeController()
	{
		parent::initializeController();
		
		// Init des Proxies et Mediators, lancement de l'application
		$this->registerCommand( StartupFacade::INIT_APPLICATION, "Pure\Patterns\Commands\Macros\InitializeApplicationMacro" );
		
		// Verifie qu'il s'agit de la vue d'install
		$this->registerCommand( StartupFacade::PREPARE_APPLICATION, "Pure\Patterns\Commands\PrepareApplicationCommand" );
		// Preparation des layouts de la vue
		$this->registerCommand( StartupFacade::PREPARE_LAYOUTS, "Pure\Patterns\Commands\PrepareLayoutCommand" );
		// Preparation des layouts de la vue
		$this->registerCommand( StartupFacade::PREPARE_CONTROLLER, "Pure\Patterns\Commands\PrepareControllerCommand" );
		
		// Lance le traitement de rendu html des enfants
		$this->registerCommand( StartupFacade::RENDER_VIEW, "Pure\Patterns\Commands\Macros\RenderViewMacro" );
		
		// Commande de redirection Liens/URL
		$this->registerCommand( StartupFacade::REDIRECT_TO, "Pure\Patterns\Commands\RedirectionCommand" );
		$this->registerCommand( StartupFacade::REDIRECT_TO_HOME, "Pure\Patterns\Commands\RedirectToHomeCommand" );
		$this->registerCommand( StartupFacade::REDIRECT_TO_ERROR, "Pure\Patterns\Commands\RedirectToErrorCommand" );
		$this->registerCommand( StartupFacade::REDIRECT_TO_INSTALL, "Pure\Patterns\Commands\RedirectToInstallCommand" );
	}
	
	/**
	 * Instance getter for the ApplicationFacade, this method
	 * starts the Facade.
	 */
	static public function getInstance()
	{
		if( !isset( parent::$instance ) )
		{
			$instance = new StartupFacade(); 
			parent::$instance = $instance;
		}
		return parent::$instance;
	}
	
}