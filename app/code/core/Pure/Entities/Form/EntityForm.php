<?php
namespace Pure\Entities\Form;

use Bluemagic\Abstracts\AbstractForm;

class EntityForm extends AbstractForm
{
    
    private $_forms;
    
    /**
     * (non-PHPdoc)
     * @see \Bluemagic\Abstracts\AbstractForm::build()
     */
    public function build()
    {
        
        $this->_forms = array();
        
        // Left Form
        $form = new AbstractForm();
		// Label
		$input = $this->createElement( "label", AbstractForm::INPUT_TYPE );
		$input->setLabel( "Label" );
		$input->setRequired( true );
		$form->addElement( $input );
		$this->_forms[ "left" ] = $form;
		
		// Name
		$input = $this->createElement( "classname", AbstractForm::INPUT_TYPE );
		$input->setLabel( "Classname" );
		$input->setRequired( true );
		$form->addElement( $input );
        
        // Right Form
        $form = new AbstractForm();
        
		$this->_forms[ "right" ] = $form;
		
		return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Bluemagic\Abstracts\AbstractForm::validate()
     */
	public function validate( $params )
	{
	    $validated = $this->_forms[ "left" ]->validate( $params );
	    if( $validated ) $validated = $this->_forms[ "right" ]->validate( $params );
	    return $validated;
	}
	
	/**
	 * @param string $name
	 * @param \Bluemagic\Abstracts\AbstractForm
	 */
	public function getPartByName( $name )
	{
	    return $this->_forms[ $name ];
	}
    
}