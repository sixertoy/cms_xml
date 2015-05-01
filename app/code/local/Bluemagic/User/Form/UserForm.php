<?php
namespace Bluemagic\User\Form;

use Bluemagic\Core\Form\AbstractForm;

class UserForm extends AbstractForm
{
	function __construct() { parent::__construct(); }
	public function build()
	{
		// Login
		$input = $this->createElement( "login", AbstractForm::INPUT_TYPE );
		$input->setLabel( "Login" );
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
		
		// Contact
		$input = $this->createElement( "email", AbstractForm::EMAIL_TYPE );
		$input->setLabel( "eMail" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		// Adresse
		/*
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
		*/		
		return $this;		
	}
	
}
