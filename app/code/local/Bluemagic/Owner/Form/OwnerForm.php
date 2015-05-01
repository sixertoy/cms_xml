<?php
namespace Bluemagic\Owner\Form;

use Bluemagic\Core\Form\AbstractForm;

class OwnerForm extends AbstractForm
{
	function __construct() { parent::__construct(); }
	public function build()
	{
		// Nom
		$input = $this->createElement( "name", AbstractForm::INPUT_TYPE );
		$input->setLabel( "Nom du Site" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		// Titre
		$input = $this->createElement( "title", AbstractForm::INPUT_TYPE );
		$input->setLabel( "Titre du Site" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		// Contact
		$input = $this->createElement( "contact", AbstractForm::EMAIL_TYPE );
		$input->setLabel( "eMail de Contact" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		// Adresse
		$input = $this->createElement( "adress", AbstractForm::TEXTAREA_TYPE );
		$input->setLabel( "Adresse" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		// Adresse
		$input = $this->createElement( "description", AbstractForm::TEXTAREA_TYPE );
		$input->setLabel( "Description" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		// Adresse
		$input = $this->createElement( "keywords", AbstractForm::TEXTAREA_TYPE );
		$input->setLabel( "Mots-Cl&eacute;" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		return $this;		
	}
	
}
