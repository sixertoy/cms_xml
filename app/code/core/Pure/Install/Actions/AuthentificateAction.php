<?php
namespace Pure\Install\Actions;


use Bluemagic\Core\Debug;
use Bluemagic\Core\Notification;

use Pure\Patterns\Proxies\ConnecterProxy;
use Pure\Patterns\Proxies\ApplicationProxy;
use Pure\Install\Form\AuthentificationForm;

use Pure\Interfaces\IAction;
use Pure\Abstracts\AbstractAction;

class AuthentificateAction extends AbstractAction implements IAction
{
	
	/**
	 * Enregistrement de la cle d'API
	 * 
	 * @param Bluemagic\Objects\Request $request
	 * @return \Pure\Install\IndexController
	 */
	public function execute( $request )
	{
					
		$this->getController()->setForm(  new AuthentificationForm() );
		$this->getController()->getForm()->setId( "install_database_form" )->build();
		$form = $this->getController()->getForm();
		
		// Si le formulaire est soumit
		if( $request->isSubmitted() )
		{
			
			$note_valid = "Les champs marqu&eacute;s d'une '*' sont obligatoires'";
			
			$params = $request->post()->toArray();
			$is_valid = $form->validate( $params );
			
			// Si le formulaire n'est pas valide
			if( !$is_valid )
			{
				$this->getController()->addFormValidationError();
			}
			else 
			{
				$crypted = $params[ "apikey_crypted" ];
				// Si la cle d'encryptage MD5 n'est envoyee avec le formulaire
				if( empty( $crypted ) )
				{
					// On remplit le form
					$this->_populateForm( $form, $params[ "apikey" ] );
					$this->_addProcessError();
				}
				// Sinon on verifie que la cle a bien ete enregistree dans le fichier
				else
				{
					$this->_populateForm( $form, $params[ "apikey" ] );
// 					$app_proxy = $this->getController()->getProxy()->getFacade()->retrieveProxy( ApplicationProxy::NAME );
// 					$api_key = $app_proxy->getApplicationKey();
					$api_key = $this->getController()->getApplicationKey();
					// Si la cle d'API n'est pas renseigne ou qu'elle n'est pas egale a celle presente dans le form 
					if( !$api_key || ( $form->getElementById( "apikey_crypted" )->getValue() != $api_key ) )
					{
						$this->_addProcessError();
					}
					// Sinon on lance la prochaine action
					else $this->getController()->gotoNextAction( "database" );
				}
				
			}
		}
		return $this;
	}
	
	private function _addProcessError()
	{
		$api_note = "Veuillez renseigner la cl&eacute; d'API dans le fichier de configuration 'etc/configs/application.ini'.";
		$api_note .= "La cl&eacute; choisie sera le mot de passe du super administrateur.";
		$this->getController()->addNotification( $api_note, Notification::WARNING );
	}
	
	private function _populateForm( $form, $apikey )
	{
		$form->getElementById( "apikey" )->setValue( $apikey );
		$form->getElementById( "apikey_crypted" )->setValue( md5( $apikey ) );
	}
	
}