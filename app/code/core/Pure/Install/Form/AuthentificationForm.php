<?php
namespace Pure\Install\Form;

use Bluemagic\Abstracts\AbstractForm;

class AuthentificationForm extends AbstractForm
{
	/**
	 * @TODO bug si les id des champs sont separes par des "_"
	 * Enter description here ...
	 */
    public function build()
    {	
		// Cle d'API
		$input = $this->createElement( "apikey", AbstractForm::INPUT_TYPE );
		$input->setLabel( "Cl&eacute; dAPI" );
		$input->setRequired( true );
		$this->addElement( $input );

		$input = $this->createElement( "apikey_crypted", AbstractForm::READ_ONLY_TYPE );
		$input->setLabel( "Cl&eacute; dAPI securis&eacute;e" );
		$input->addClass( "crypted" );
		$this->addElement( $input );
		
		return $this;	        
    }
}
