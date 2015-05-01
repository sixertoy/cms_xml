<?php
namespace Pure\Core\Blocks;

use Pure\Abstracts\AbstractBlock;
use Bluemagic\Loaders\ConfigLoader;

class Breadcrumbs extends AbstractBlock
{
	private $_link;
	private $_steps;
	private $_labels;
	private $_ini_config;
	
    private $_next_step;
	private $_current_step;
	private $_previous_step;
	
	public function __construct( $parent )
	{
		parent::__construct( $parent );
		
		$loader = new ConfigLoader();
		$this->_ini_config = $loader->load( "breadcrumbs" );
		
		$this->_steps = array();
		$this->_labels = array();
		$this->_next_step = false;
		$this->_current_step = false;
		$this->_previous_step = false;
		$this->_link = $this->getCurrentLink()->removeAction();
	}
	
	/**
	 * 
	 * @param string $key
	 * @param string $label
	 * @return boolean|\Pure\Core\Blocks\Breadcrumbs
	 */
	public function addStep( $key )
	{
		if( array_key_exists( $key, $this->_labels ) ) return false;	
		$this->_steps[] = $key;
		$this->_labels[ $key ] = "io";
		return $this;
	}
	
//{region Getter

	public function isCurrentStep()
	{
		$this->_current_step = $value;
		return $this;
	}
	
	public function getSteps()
	{
		return $this->_steps;
	}
	
	public function getPreviousStep()
	{
		return $this->_previous_step;
	}
	
	public function getNextStep()
	{
		return $this->_next_step;
	}
	
	public function getCurrentStep()
	{
		return $this->_current_step;
	}
	
//}region Getter
//{region Setter
	
	/**
	 * 
	 * @param array $value
	 * @return boolean|\Pure\Core\Blocks\Breadcrumbs
	 */
	public function steps( $value )
	{
		foreach( $value as $key )
		{
			$added = $this->addStep( $key );
			if( !$added ) return false; 
		}
		return $this;
	}
	
	/**
	 * 
	 * @param string $value
	 * @return \Pure\Core\Blocks\Breadcrumbs
	 */
	public function currentStep( $value )
	{
		$this->_current_step = $value;
		return $this;
	}
	
	/**
	 * 
	 * @param string $value
	 * @return \Pure\Core\Blocks\Breadcrumbs
	 */
	public function previousStep( $value )
	{
		$this->_previous_step = $value;
		return $this;
	}
	
	/**
	 * 
	 * @param string $value
	 * @return \Pure\Core\Blocks\Breadcrumbs
	 */
	public function nextStep( $value )
	{
		$this->_next_step = $value;
		return $this;
	}
	
//}region Setter

}
