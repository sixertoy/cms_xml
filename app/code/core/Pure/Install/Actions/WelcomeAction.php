<?php
namespace Pure\Install\Actions;

use Pure\Interfaces\IAction;
use Pure\Abstracts\AbstractAction;

class WelcomeAction extends AbstractAction implements IAction
{
	
	/**
	 * Ecran de bienvenue
	 * 
	 * @param Bluemagic\Objects\Request $request
	 * @return \Pure\Install\IndexController
	 */
	public function execute( $request )
	{
		
		$isSubmitted = $request->isSubmitted();
		if( $isSubmitted ) $this->getController()->gotoNextAction( "config" );
		
	}
}