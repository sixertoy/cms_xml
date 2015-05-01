<?php
namespace Pure\Entities\Actions;

use Pure\Entities\Form\EntityForm;

use Pure\Patterns\Proxies\ApplicationProxy;

use Bluemagic\Core\Debug;

use Pure\Interfaces\IAction;
use Pure\Abstracts\AbstractAction;

class AddAction extends AbstractAction implements IAction
{
	
	/**
	 * Ecran de configuration de l'utilisateur SuperAdmin
	 * 
	 * @param Bluemagic\Objects\Request $request
	 * @return \Pure\Install\IndexController
	 */
	public function execute( $request )
	{
	    $form = new EntityForm();
	    $this->getController()->setForm( $form );
		$this->getController()->getForm()->setId( "entity-form" )->build();
		
		$block = $this->getController()->getView()->getBlockById( "content.inner.left" );
		$block->setForm( $form->getPartByName( "left") );
		
		$block = $this->getController()->getView()->getBlockById( "content.inner.right" );
		$block->setForm( $form->getPartByName( "right") );
		
		/*
		$this->getController()->setForm( new UserAdminForm() );
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
				$saved = DomHelper::saveXML( $xml_string, ApplicationProxy::SUPERADMIN_TEMP_FILE );
				if( !$saved ) $this->getController()->addProcessError();
				else $this->getController()->gotoNextAction( "site" );
			}
		}
		
		$loaded = DomHelper::loadXML( ApplicationProxy::SUPERADMIN_TEMP_FILE );
		if( $loaded ) $form->hydrateWithXML( $loaded );
		*/	    
		return $this;
	}
}