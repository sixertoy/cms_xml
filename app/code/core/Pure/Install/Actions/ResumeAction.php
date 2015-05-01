<?php
namespace Pure\Install\Actions;

use Pure\Patterns\Proxies\ApplicationProxy;

use Bluemagic\Helpers\DomHelper;

use Pure\Install\Actions\SiteAction;
use Pure\Install\Actions\AdminAction;
use Pure\Install\Actions\DatabaseAction;

use Pure\Interfaces\IAction;
use Pure\Abstracts\AbstractAction;
use Pure\Core\PureConstants;

class ResumeAction extends AbstractAction implements IAction
{
	
	/**
	 * Si le formulaire est soumit
	 * On recupere les cookies pour creer les fichiers de configs XML
	 * On redirige vers la vue d'importation des jeux de donnees
	 * 
	 * @param Bluemagic\Objects\Request $request
	 * @return \Pure\Install\IndexController
	 */
	public function execute( $request )
	{
		
		if( $request->isSubmitted() )
		{
			$this->getController()->gotoNextAction( "install" );
		}
		
		$dom = DomHelper::loadXML( PureConstants::SITE_TEMP_FILE );
		$this->getController()->setSiteInfos( DomHelper::toArray( $dom ) );
		
		$dom = DomHelper::loadXML( PureConstants::DATABASE_TEMP_FILE );
		$this->getController()->setDatabaseInfos( DomHelper::toArray( $dom ) );
		
		$dom = DomHelper::loadXML( PureConstants::SUPERADMIN_TEMP_FILE );
		$this->getController()->setSuperadminInfos( DomHelper::toArray( $dom ) );
		
		return $this;

	}
	
}