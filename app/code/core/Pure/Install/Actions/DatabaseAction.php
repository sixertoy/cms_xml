<?php
namespace Pure\Install\Actions;

use Bluemagic\Utils\DatabaseUtils;

use Pure\Patterns\Proxies\ApplicationProxy;

use Pure\Patterns\Proxies\ConnecterProxy;

use Bluemagic\Helpers\DomHelper;

use Bluemagic\Core\Notification;

use Pure\Install\Form\DatabaseForm;

use Bluemagic\Core\Connecter;

use Bluemagic\Loaders\DBConfigLoader;

use Bluemagic\Core\Crypter;

use Pure\Interfaces\IAction;
use Pure\Abstracts\AbstractAction;
use Pure\Core\PureConstants;

class DatabaseAction extends AbstractAction implements IAction
{
	
	/**
	 * Affiche le formulaire de configuration de la BDD
	 * Verifie que le cookie de l'etat d'avancement de l'installation l'autorise
	 * 
	 *  Si le formulaire est soumit
	 *  On verifie que la base de donnees existe
	 *  
	 *  Si la base de donnees existe
	 *  On Cree le fichier d'infos sur la BDD
	 *  
	 * @param Bluemagic\Objects\Request $request
	 * @return \Pure\Install\IndexController
	 */
	public function execute( $request )
	{
		
		$this->getController()->setForm( new DatabaseForm() );
		$this->getController()->getForm()->setId( "install_database_form" )->build();
		$form = $this->getController()->getForm();
		
		// Si le formulaire est soumit
		if( $request->isSubmitted() )
		{
			
			$params = $request->post()->toArray();
			$is_valid = $form->validate( $params );
			$form->hydrateWithArray( $params );
			
			// Si le formulaire n'est pas valide
			if( !$is_valid )
			{
				$this->getController()->addFormValidationError();
			}
			else
			{
				// Enregistre le fichier XML contenant les identifiants de la base de donnees
				$xml_string = $request->post()->toXML();
				$saved = DomHelper::saveXML( $xml_string, PureConstants::DATABASE_TEMP_FILE );
				if( !$saved ) $this->getController()->addProcessError();
				else
				{
					// On verifie la disponibilite de la BDD
					$host = trim( $params[ "bddhost" ] );
					$user = trim( $params[ "bdduser" ] );
					$name = trim( $params[ "bddname" ] );
					$password = trim( $params[ "bddpassword" ] );
					
					if( empty( $password ) )
					{
						$note = "Votre BDD n'est pas s&eacute;curis&eacute;e par un mot de passe.";
						$this->getController()->addNotification( $note, Notification::WARNING );
					}
					
					$db_ready = DatabaseUtils::isDatabaseAvailable( $host, $name, $user, $password );
					
					if( !$db_ready )
					{
						$note = "Impossible de se connecter &agrave; la base de donn&eacute;es. ";
						$note .= "Vous devez cr&eacute;er une base de donn&eacute;es avant de continuer.";
						$this->getController()->addNotification( $note, Notification::WARNING );
					}
					else $this->getController()->gotoNextAction( "admin" );
				}
			}
		}
		
		$loaded = DomHelper::loadXML( PureConstants::DATABASE_TEMP_FILE );
		if( $loaded ) $form->hydrateWithXML( $loaded );
				
		return $this;
		
	}
}