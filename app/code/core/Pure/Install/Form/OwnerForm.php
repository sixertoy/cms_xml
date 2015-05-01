<?php
namespace Pure\Install\Form;

use Bluemagic\Abstracts\AbstractForm;

class OwnerForm extends AbstractForm
{
    public function build()
    {
		// Mot de passe
		$input = $this->createElement( "domain", AbstractForm::INPUT_TYPE );
		$input->setLabel( "Domaine" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		// Username
		$input = $this->createElement( "title", AbstractForm::INPUT_TYPE );
		$input->setLabel( "Titre du site" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		// eMail
		$input = $this->createElement( "email", AbstractForm::EMAIL_TYPE );
		$input->setLabel( "eMail de contact" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		return $this;	        
    }
    
}
