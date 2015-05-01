<?php
namespace Pure\Install;

use DomDocument;

use Bluemagic\Core\Debug;
use Bluemagic\Core\Crypter;
use Bluemagic\Core\Connecter;
use Bluemagic\Utils\StringUtils;
use Bluemagic\Core\Notification;
use Bluemagic\Core\PHPConstants;
use Bluemagic\Helpers\DomHelper;
use Bluemagic\Utils\DatabaseUtils;
use Bluemagic\Abstracts\AbstractForm;
use Bluemagic\Loaders\DBConfigLoader;
use Bluemagic\Singleton\CookieFactory;

use Pure\Core\DoctrineRun;
use Pure\Interfaces\IController;
use Pure\Abstracts\AbstractAction;
use Pure\Abstracts\AbstractController;
use Pure\Patterns\Proxies\ConnecterProxy;

use Pure\Install\Form\OwnerForm;
use Pure\User\Form\UserAdminForm;
use Pure\Install\Form\DatabaseForm;
use Pure\Install\Form\AuthentificationForm;

use Pure\Install\InstallController;
use Pure\Install\Actions\SiteAction;
use Pure\Install\Actions\AdminAction;
use Pure\Install\Actions\InstallAction;
use Pure\Install\Actions\DatabaseAction;

class IndexController extends AbstractController implements IController
{
	const COOKIE_GPS_NAME = "pure_gps_values";
	
	public function initializeActions()
	{
		$this->registerAction( "welcome", "Pure\Install\Actions\WelcomeAction" );
		$this->registerAction( "config", "Pure\Install\Actions\ConfigAction" );
		$this->registerAction( "authentificate", "Pure\Install\Actions\AuthentificateAction" );
		$this->registerAction( "database", "Pure\Install\Actions\DatabaseAction" );
		$this->registerAction( "admin", "Pure\Install\Actions\AdminAction" );
		$this->registerAction( "site", "Pure\Install\Actions\SiteAction" );
		$this->registerAction( "resume", "Pure\Install\Actions\ResumeAction" );
		$this->registerAction( "complete", "Pure\Install\Actions\CompleteAction" );
		$this->registerAction( "start", "Pure\Install\Actions\startAction" );
		
		// @TODO Pas d'erreurs sur l'appel des responder AJAX
		$this->registerAction( "install", "Pure\Install\Actions\InstallAction" );
		$this->registerAction( "installAsync", "Pure\Install\Async\InstallAsyncAction" );

	}
	
	/**
	 * Verifie si le cookie de demarrage de l'installation a ete cree
	 * 
	 * Si le pas d'installation n'a jamais ete atteint
	 * On redirige vers une vue lui indiquant
	 * Qu'il n'a pas les droits d'acces a la page
	 * 
	 * Cree un cookie pour signaler le debut de l'installation
	 * Cree un cookie pour connaitre l'etat d'avancement de l'installation
	 */
	public function __setUp( $is_ajax, $request )
	{
		$this->setForm( new AbstractForm() );
		$this->getForm()->setId( "install_form" )->build();
		
		// Verifie si le cookie de demarrage de l'installation a ete cree
		if( !$this->_isInitialized() )
		{
			$action = "welcome";
			$this->addActionToGPS( $action );
			$current_action = $this->getView()->getCurrentAction();
			if( ( $current_action != $action ) && !empty( $current_action ) && !is_null( $current_action ) )
			{
				$action = $this->getView()->getCurrentLink()->setAction( $action );
				$this->getView()->redirectTo( $action );
			}
		}
		else
		{
			// Si le pas d'installation n'a jamais ete atteint
			// On redirige vers une vue en indiquant
			// Qu'il n'a pas les droits d'acces a la page
			$action = $this->getView()->getCurrentAction();
			if( isset( $action ) && !empty( $action ) )
			{
				if( $is_ajax ) return $this;
				if( !$this->_hasActionGPS( $action ) ) $this->getView()->redirectToRestrictedError();
			}
		}
		return $this;
	}
	
	/**
	 * Redirige la vue vers la prochaine action
	 * 
	 * @param string $action
	 */
	public function gotoNextAction( $action )
	{
		$this->addActionToGPS( $action );
		$action = $this->getView()->getCurrentLink()->setAction( $action );
		$this->getView()->redirectTo( $action );
		exit();
	}
	
	/**
	 * Ajoute l'action au Cookie d'historique d'installation
	 */
	public function addActionToGPS( $action )
	{
		$added = false;
		$contains = $this->_hasActionGPS( $action );
		if( !$contains )
		{ 
			$gps_cookie = CookieFactory::get( self::COOKIE_GPS_NAME );
			$gps_cookie = $gps_cookie.( ( $gps_cookie ) ? "," : "" ).$action;
			$added = CookieFactory::add( self::COOKIE_GPS_NAME, $gps_cookie );
		}
		return $added;
	}
	
	/**
	 * Message d'erreur pour le form
	 */
	public function addFormValidationError()
	{
		$message = "Le formulaire comporte des erreurs. Tous les champs marqu&eacute;s d'une '*' sont requis";
		$this->addNotification( $message, Notification::WARNING );
		Debug::trace( $message, Debug::ERROR );	
	}
	
	/**
 	 * Erreur durant le processus d'installation
 	 */
	protected function addProcessError()
	{
		$message = "Impossible de sauvegarder le fichier";
		Debug::trace( $message, Debug::ERROR );
		$message = "Une erreur est survenue durant le processus d'installation";
		$this->addNotification( $message );
	}
	
	/**
	 * Verifie si le cookie d'historique d'installation
	 * A deja ete sette
	 */
	protected function _hasActionGPS( $action )
	{
		$gps_cookie = CookieFactory::get( self::COOKIE_GPS_NAME );
		$is_pos = strpos( $gps_cookie, $action );
		return !( $is_pos === false );
	}
	
	/**
	 * Verifie si les cookies sont prets pour linstallation
	 * @return Ambigous <boolean, unknown>
	 */
	protected function _isInitialized()
	{
		$cookie = CookieFactory::get( self::COOKIE_GPS_NAME );
		return $cookie;
	}
	
}