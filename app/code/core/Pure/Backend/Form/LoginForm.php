<?php
namespace Pure\Backend\Form;

use Bluemagic\Abstracts\AbstractForm;

class LoginForm extends AbstractForm
{
    public function build()
    {
		// Mot de passe
		$input = $this->createElement( "username", AbstractForm::INPUT_TYPE );
		$input->setLabel( "Username" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		// Username
		$input = $this->createElement( "password", AbstractForm::PASSWORD_TYPE );
		$input->setLabel( "Password" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		return $this;	        
    }
    
}
