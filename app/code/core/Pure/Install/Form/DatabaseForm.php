<?php
namespace Pure\Install\Form;

use Bluemagic\Abstracts\AbstractForm;

class DatabaseForm extends AbstractForm
{
	/**
	 * @TODO bug si les id des champs sont separes par des "_"
	 * Enter description here ...
	 */
    public function build()
    {
		
		// Name DB
		$input = $this->createElement( "bddname", AbstractForm::INPUT_TYPE );
		$input->setLabel( "Nom de la base de donn&eacute;es" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		// Host DB
		$input = $this->createElement( "bddhost", AbstractForm::INPUT_TYPE );
		$input->setLabel( "Serveur" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		// Utilisateur DB
		$input = $this->createElement( "bdduser", AbstractForm::INPUT_TYPE );
		$input->setLabel( "Utilisateur" );
		$input->setRequired( true );
		$this->addElement( $input );
		
		// Password DB
		$input = $this->createElement( "bddpassword", AbstractForm::INPUT_TYPE );
		$input->setLabel( "Mot de passe" );
		$this->addElement( $input );
		
		return $this;	        
    }
}
