<?php
namespace Pure\Core;

use PureMVC\Patterns\Facade\Facade;
use Pure\Patterns\Proxies\ConfigProxy;
use Pure\Patterns\Proxies\RequestProxy;
use Pure\Patterns\Proxies\ControllerProxy;
use Pure\Patterns\StartupFacade;
use Bluemagic\Core\Link;

class ApplicationFacade extends Facade
{
//{region RedirectionCommand Helper

	public function redirectTo( $link )
	{
		$this->sendNotification( StartupFacade::REDIRECT_TO, $link );
		return $this;
	}
	
	public function redirectToError( $code=null )
	{
		$request_proxy = $this->retrieveProxy( RequestProxy::NAME );
		$link = $request_proxy->getErrorLink();
		if( isset( $code ) && !is_null( $link ) && !empty( $code ) ) $link->setAction( $code );
		return $this->redirectTo( $link );
	}
	
	public function redirectToNotFoundError(){ return $this->redirectToError( "error404" ); }
	
	public function redirectToRestrictedError(){ return $this->redirectToError( "error500" ); }
	
//}region RedirectionCommand Helper
//{region RequestProxy Helper

	public function getBaseURL(){ return $this->retrieveProxy( RequestProxy::NAME )->getBaseURL(); }
	
	public function getCurrentLink(){ return $this->retrieveProxy( RequestProxy::NAME )->getCurrentLink(); }
	
	public function getCurrentView(){ return $this->retrieveProxy( RequestProxy::NAME )->getCurrentView(); }
	
	public function getCurrentLayout(){ return $this->retrieveProxy( RequestProxy::NAME )->getCurrentLayout(); }
	
	public function getCurrentAction(){ return $this->retrieveProxy( RequestProxy::NAME )->getCurrentAction(); }
	
//}region RequestProxy Helper
	
	public function getHelper( $id=null )
	{
		$proxy = $this->retrieveProxy( ControllerProxy::NAME );
		if( is_null( $id ) || empty( $id ) ) return $proxy->getController();
		else $proxy->getControllerById( $id );
	}

	public function isApplicationReady()
	{
		$config_proxy = $this->retrieveProxy( ConfigProxy::NAME );
		$api_key = $config_proxy->getAPIKey();
		if( !$api_key ) return false;
		$ready = ( file_exists( PureConstants::DATABASE_SECURED_FILE ) );
		if( !$ready ) return false;
		return true;
	}
	
	public function getApplicationKey()
	{
		$config_proxy = $this->retrieveProxy( ConfigProxy::NAME );
		$api_key = $config_proxy->getAPIKey();
		return $api_key;
	}
	
	/**
	 * Retourne un lien HTML
	 * 
	 * @param string $view
	 * @param string $layout
	 * @param string $action
	 * @param string $params
	 * @param string $output
	 * @return Ambigous <string, boolean, multitype:>
	 */
	public function getLink( $view, $layout, $action=false, $params=false, $output="html" )
	{
		$link = new Link( $view );
		$link->setLayout( $layout );
		if( $action ) $link->setAction( $action );
		if( $params ) $link->addParams( $params );
		return $link->get( $output );
	}
	
	/*
	public function getCurrentURL()
	{
		$request_proxy = $this->getFacade()->retrieveProxy( RequestProxy::NAME );
		return $request_proxy->getCurrentURL();
	}
		
	public function getCurrentRequest()
	{
		$request_proxy = $this->getFacade()->retrieveProxy( RequestProxy::NAME );
		return $request_proxy->getCurrentRequest();
	}
	*/
	/**
	 * Retourne le layout actuel de la vue
	 * @return string
	 */
	/*
	*/
	/**
	 * Retourne le mode d'environnement de l'application
	 * 
	 * @return boolean
	 */
	/*
	public function isProductionMode()
	{
	    return $this->getData()->is_production;
	}
	*/
}