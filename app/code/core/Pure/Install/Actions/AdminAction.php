<?php
namespace Pure\Install\Actions;

use Pure\Patterns\Proxies\ApplicationProxy;

use DOMDocument;

use Bluemagic\Core\Debug;
use Bluemagic\Helpers\DomHelper;

use Pure\Interfaces\IAction;
use Pure\Abstracts\AbstractAction;
use Pure\User\Form\UserAdminForm;
use Pure\Core\PureConstants;

class AdminAction extends AbstractAction implements IAction
{
	
	/**
	 * Ecran de configuration de l'utilisateur SuperAdmin
	 * 
	 * @param Bluemagic\Objects\Request $request
	 * @return \Pure\Install\IndexController
	 */
	public function execute( $request )
	{
		
		$this->getController()->setForm( new UserAdminForm() );
		$this->getController()->getForm()->setId( "installsuperadmin-form" )->build();
		$form = $this->getController()->getForm();

		// Verifie si le form est soumit
		if( $request->isSubmitted() )
		{
			// On recupere les informations du form
			$params = $request->post()->toArray();
			$is_valid = $form->validate( $params );
			$form->hydrateWithArray( $params );
			if( !$is_valid ) $this->getController()->addFormValidationError();
			else
			{
				$xml_string = $request->post()->toXML();
				$saved = DomHelper::saveXML( $xml_string, PureConstants::SUPERADMIN_TEMP_FILE );
				if( !$saved ) $this->getController()->addProcessError();
				else $this->getController()->gotoNextAction( "site" );
			}
		}
		
		$loaded = DomHelper::loadXML( PureConstants::SUPERADMIN_TEMP_FILE );
		if( $loaded ) $form->hydrateWithXML( $loaded );
		
		return $this;
	}
}