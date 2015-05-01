<?php
namespace Pure\Install\Actions;

use Bluemagic\Core\Notification;
use Bluemagic\Utils\DatabaseUtils;
use Bluemagic\Core\PHPConstants;
use Bluemagic\Singleton\CookieFactory;

use Pure\Interfaces\IAction;
use Pure\Install\IndexController;
use Pure\Abstracts\AbstractAction;

class ConfigAction extends AbstractAction implements IAction
{
	
	/**
	 * Verification de la configuration serveur
	 * 
	 * @param Bluemagic\Objects\Request $request
	 * @return \Pure\Install\IndexController
	 */
	public function execute( $request )
	{
		$isSubmitted = $request->isSubmitted();
		if( $isSubmitted ) $this->getController()->gotoNextAction( "authentificate" );
		else $this->_getServerConfiguration();
	}
	
	/**
	 * En cas d'erreurs bloquantes la vue d'installation est bloquee
	 * 
	 * @return boolean
	 */
	private function _getServerConfiguration()
	{
		// Bloquants/Obligatoires
		$cookie_activation = CookieFactory::get( IndexController::COOKIE_GPS_NAME );
		if( !$cookie_activation ) $this->getController()->addNotification( "Les cookies ne sont pas activ&eacute;s.", Notification::ERROR );
		$this->getController()->setCookieActivation( $cookie_activation );
		
		$php_version = ( floatval( substr( phpversion(), 0, 1 ) ) >= 5 ); // 5.3 pour doctrine
		if( !$php_version ) $this->getController()->addNotification( "Votre version de PHP ne permet pas l'installation de l'application.", Notification::ERROR );
		$this->getController()->setPHPVersion( $php_version );
		
		$mysql_driver = DatabaseUtils::isDriverAvailable();
		if( !$mysql_driver ) $this->getController()->addNotification( "L'utilisation de MySQL n'est pas possible.", Notification::ERROR );
		$this->getController()->setMySQLDriver( $mysql_driver );
		
		$apache_mods = apache_get_modules();
		$mod_rewrite = in_array( PHPConstants::APACHE_MOD_REWRITE, $apache_mods );
		if( !$mod_rewrite ) $this->getController()->addNotification( "La r&eacute;&eacute;criture d'URL n'est pas activ&eacute;e.", Notification::ERROR );
		$this->getController()->setModRewrite( $mod_rewrite );
		
		$pdo_defined = defined( "PDO::ATTR_DRIVER_NAME" );
		if( !$pdo_defined ) $this->getController()->addNotification( "L'extension PDO n'est pas activ&eacute;e", Notification::ERROR );
		$this->getController()->setPDODefined( $pdo_defined );
		
		// Optionnels
		$console_runner = ini_get( "register_argc_argv" );
		if( !$console_runner ) $this->getController()->addNotification( "L'utilisation du mode console n'est pas possible.", Notification::WARNING );
		$this->getController()->setConsolRunner( $console_runner );

		$mod_spelling = in_array( PHPConstants::APACHE_MOD_SPELLING, $apache_mods );
		if( !$mod_spelling ) $this->getController()->addNotification( "Votre configuration serveur est sensible &agrave; la casse.", Notification::WARNING );
		$this->getController()->setModSpelling( $mod_spelling );
		
		$apc_enabled = (bool) ini_get(  "apc.enabled" );
		if( !$apc_enabled ) $this->getController()->addNotification( "Le cache APC n'est pas activ&eacute;/install&eacute;.", Notification::WARNING );
		$this->getController()->setAPCCache( $apc_enabled );
	
		return true;
		
	}
	
}