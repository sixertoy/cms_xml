<?php
namespace Pure\Core;

use Pure\Patterns\Proxies\ConnecterProxy;

use Pure\Patterns\Proxies\RequestProxy;

use Bluemagic\Singleton\CookieFactory;

use Pure\Abstracts\AbstractController;

class AuthController extends AbstractController
{
    
    /**
     * (non-PHPdoc)
     * @see \Pure\Abstracts\AbstractController::__setUp()
     */
	public function __setUp( $is_ajax, $request )
	{
		$request_proxy = $this->getProxy()->getFacade()->retrieveProxy( RequestProxy::NAME );
		$connecter_proxy = $this->getProxy()->getFacade()->retrieveProxy( ConnecterProxy::NAME );
		
		$session = $connecter_proxy->getSessionRunner();
		$session->start();
		
		if( !$connecter_proxy->isConnected() && !( $request_proxy->getCurrentLayout() === "login" ) )
		{
			$link = $request_proxy->getCMSLink();
			$this->redirectTo( $link->setLayout( "login" ) );
			exit();
		}
		
		parent::__setUp( $is_ajax, $request );
		
	}
}