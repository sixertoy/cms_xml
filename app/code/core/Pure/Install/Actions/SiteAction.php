<?php
namespace Pure\Install\Actions;

use Pure\Patterns\Proxies\ApplicationProxy;

use DOMDocument;

use Bluemagic\Core\Debug;

use Bluemagic\Helpers\DomHelper;

use Pure\Install\Form\OwnerForm;

use Pure\Interfaces\IAction;
use Pure\Abstracts\AbstractAction;
use Pure\Core\PureConstants;

class SiteAction extends AbstractAction implements IAction
{
	
	/**
	 * 
	 * @param Bluemagic\Objects\Request $request
	 * @return \Pure\Install\IndexController
	 */
	public function execute( $request )
	{
		
	    $this->getController()->setForm( new OwnerForm() );
	    $this->getController()->getForm()->setId( "installowner-form" )->build();
	    $form =  $this->getController()->getForm();
	    
		if( $request->isSubmitted() )
		{

			$params = $request->post()->toArray();
			$is_valid = $form->validate( $params );
			$form->hydrateWithArray( $params );
			
			if( !$is_valid ) $this->getController()->addFormValidationError();
			else
			{
				$xml_string = $request->post()->toXML();
				$saved = DomHelper::saveXML( $xml_string, PureConstants::SITE_TEMP_FILE );
				if( !$saved ) $this->getController()->addProcessError();
				else $this->getController()->gotoNextAction( "resume" );
			}
		}
		
		$loaded = DomHelper::loadXML( PureConstants::SITE_TEMP_FILE );
		if( $loaded ) $this->getController()->getForm()->hydrateWithXML( $loaded );
		
		return $this;
	}	
}