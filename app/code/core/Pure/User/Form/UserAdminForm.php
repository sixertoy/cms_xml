<?php
namespace Pure\User\Form;

use Bluemagic\Abstracts\AbstractForm;

class UserAdminForm extends AbstractForm
{
    public function build()
    {
		// Username
		$input = $this->createElement( "username", AbstractForm::INPUT_TYPE );
		$input->setLabel( "Username" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		// Mot de passe
		$input = $this->createElement( "password", AbstractForm::PASSWORD_TYPE );
		$input->setRequired( true );
		$input->setNeedValidation( true );
		$input->setLabel( "Mot de passe" );
		$this->addElement( $input );
		
		// eMail
		$input = $this->createElement( "email", AbstractForm::EMAIL_TYPE );
		$input->setLabel( "eMail" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		// Prenom
		$input = $this->createElement( "firstname", AbstractForm::INPUT_TYPE );
		$input->setLabel( "Pr&eacute;nom" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		// Nom
		$input = $this->createElement( "lastname", AbstractForm::INPUT_TYPE );
		$input->setLabel( "Nom" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		return $this;	        
    }
    
}
