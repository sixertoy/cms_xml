<?php
namespace Pure\Core;

use Pure\Patterns\Proxies\RequestProxy;

use Pure\Backend\Form\LoginForm;

use Pure\Core\AuthController;
use Pure\Interfaces\IController;

class LoginController extends AuthController implements IController
{
	public function initializeActions(){}
	
	/**
	 * (non-PHPdoc)
	 * @see \Pure\Core\AuthController::__setUp()
	 */
	public function __setUp( $is_ajax, $request )
	{	    
	    $name = "Pure\Models\User";
        $this->setEntityName( $name );
	    parent::__setUp( $is_ajax, $request );
	}
	
	/**
	 * 
	 * @param unknown $request
	 * @return \Pure\Core\LoginController
	 */
	public function authentificateAction( $request )
	{
	    // Verifie si le form est soumit
		if( $request->isSubmitted() )
		{
		    $args = array
		    (
                "username"=>$request->post()->getUsername(),
                "password"=>md5( $request->post()->getPassword() )
            );
		    $user = $this->findBy( $args );
		    if( $user )
		    {
		        // Ouverture d'une session
		        $_SESSION[ "connected" ] = $user->getUserId();
			    $link = $this->getProxy()->getFacade()->retrieveProxy( RequestProxy::NAME )->getCMSLink();
			    $this->redirectTo( $link->setLayout( "dashboard" ) );
			    exit();
		    }
		    else
		    {
		    	// @TODO blocage de la session au dela de 5 tentatives
		    }
		}
	    
		$this->setForm( new LoginForm() );
		$this->getForm()->setId( "login_form" )->build();
		$form = $this->getForm();
		return $this;
	    
	}
	
}