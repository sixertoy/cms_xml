<?php
namespace Pure\Abstracts;

use Bluemagic\Utils\StringUtils;

use Bluemagic\Core\Debug;
use Pure\Singleton\BlockFactory;
use Pure\Interfaces\IAsynchronous;

class AbstractBlock
{
	
	protected $_id;
	protected $_type;
	protected $_parent;
	protected $_template;
	protected $_childNodes;
	protected $_childs_map;
	protected $_callMethods;
// 	protected $_use_template;
	protected $_is_debuggable;
	protected $_top_level_root;
	
	public function __construct( $parent )
	{ 
		$this->_parent = $parent;
		$this->_is_debuggable = true;
	}
	
	/**
	 * 
	 * @return \Pure\Abstracts\AbstractBlock
	 */
	protected function __setUp()
	{
		$this->_callMethodsFormXML();
		return $this;
	}
	
	/**
	 * 
	 * @return \Pure\Abstracts\AbstractBlock
	 */
	protected function __tearDown()
	{
		if( empty( $this->_childs_map) ) return $this;
		return $this;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function __toString()
	{
		return $this->getClassName();
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getId()
	{
		return $this->_id;
	}
	
	/**
	 * 
	 * @param string $pValue
	 * @return \Pure\Abstracts\AbstractBlock
	 */
	public function setId( $pValue )
	{
		$this->_id = $pValue;
		return $this;
	}
	
	/*
	public function useTemplate()
	{
		return $this->_use_template;
	}
	
	public function setUseTemplate( $value )
	{
		if( StringUtils::isBoolean( $value ) )
		{
			$value = StringUtils::toBoolean( $value );
			$this->_use_template = $value;
		}
		return $this;
	}
	*/
    
	/**
	 * Determine si le block beneficie du layout hover debug
	 * @return boolean
	 */ 
	public function getDebuggable()
	{
		return $this->_is_debuggable;
	}
	
	/**
	 * 
	 * @param string $pValue
	 * @return \Pure\Abstracts\AbstractBlock
	 */
	public function setDebuggable( $value )
	{
		if( StringUtils::isBoolean( $value ) ) $this->_is_debuggable = StringUtils::toBoolean( $value );
		else $this->_is_debuggable = false;
		return $this;
	}
	
	/**
	 * Retourne le template pour le block en cours
	 * @return string
	 */
	public function getTemplate()
	{
		return $this->_template;
	}
	
	/**
	 * Affecte un template au block
	 * Le template peut etre setter a false dans le XML
	 * 
	 * @param string $value
	 * @return \Pure\Abstracts\AbstractBlock
	 */
	public function setTemplate( $value )
	{
		if( StringUtils::isBoolean( $value ) ) $this->_template = false;
		else $this->_template = $value;
		return $this;
	}
	
	/**
	 * Retourne le type/class pour le block en cours
	 * @return string
	 */
	public function getType()
	{
		return $this->_type;
	}
		
	/**
	 * 
	 * @param string $pValue
	 * @return \Pure\Abstracts\AbstractBlock
	 */
	public function setType( $pValue )
	{
		if( is_null( $pValue ) ) $this->_type = $this->getId();
		else $this->_type = $pValue;
		return $this;
	}
	
	/**
	 * Si la classe etend la classe de responder AJAX
	 * @return boolean
	 */
	public function isAsynchronous()
	{
	    return ( $this instanceof IAsynchronous );
	}
	
	public function getParent()
	{
		return $this->_parent;
		/*return $this->getBlockById( $this->getParent()->getId() );*/
	}
	
	public function getChilds()
	{
		return $this->_childs_map;
	}
	
	public function getChildById( $id )
	{
		return $this->_childs_map[ $id ];
	}
	
	public function getChildNodes()
	{
		return $this->_childNodes;
	}
	
    /**
     * Retourne le nom de la classe de l'objet
     * @return string
     */
    public function getClassName()
    {
    	$class = get_class( $this );
    	$exploded = explode( BlockFactory::CLASS_NAME_SPLITTER, $class );
    	return $exploded[ count( $exploded ) - 1 ];
    }
    
    /**
     * 
     * @return string
     */
    public function getFullClassName()
    {
    	return get_class( $this );
    }
	
    /**
     * 
     * @param StdClass $target
     * @param string $method
     * @return boolean
     */
	private function _hasMethod( $target, $method )
    {
		$class_methods = get_class_methods( $target );
		return in_array( $method, $class_methods );
    }
	
	/**
	 * Apelle les functions envoyees depuis le <call> XML
	 * Les appels anonymes ne sont pas autorises sur les class de type blocks
	 * 
	 * Si les methodes n'existent pas
	 * Elles remontent sur le __call
	 */
	protected function _callMethodsFormXML()
	{
		if( !isset( $this->_callMethods ) || empty( $this->_callMethods ) ) return false;
		foreach( $this->_callMethods as $calls )
		{
		    $args = $calls[ 1 ];
		    $method = $calls[ 0 ];
			call_user_func_array( array( $this, $method ), $args );
		}
		return true;
	}
	
	/**
	 *  Les methodes passees call dans le XML
	 *  Seront appellees sur le render de la vue
	 *  Apres l'initialization de l'ApplicationMediator
	 *  
	 * @param unknown $commands
	 */
	public function addCallMethods( $commands )
	{
		if( !isset( $this->_callMethods ) ) $this->_callMethods = array();
		$this->_callMethods = array_merge( $commands, $this->_callMethods );
	}
	
	/**
	 * Parcours les objets enfants
	 * Initialize les classes de Blocks
	 * 
	 * Si la classe n'est pas definit
	 * On utilise la classe Bluemagic\Abstracts\Blocks\AbstractBlocks
	 * 
	 * @TODO Ajoute l'id du parent a l'id de l'enfant
	 * 
	 * @param DOMNodeList $pChilds
	 * @return Pure\Abstracts\AbstractBlock
	 */
	public function parseChilds( $childnodes )
	{
		$this->_childNodes = $childnodes;
		$this->_childs_map = BlockFactory::parseBlockChilds( $this );
		return $this->_childs_map;
	}
	
	/**
	 * Lance le rendu d'un enfant du block
	 * Depuis la vue HTML
	 * 
	 * @param string $id
	 * @return boolean
	 */
	public function getChildHtml( $id )
	{
		$block = null;		
		if( strpos( $id, "." ) > 0 )
		{
			$block = $this;
			$exploded_id = explode( ".", $id );
			foreach( $exploded_id as $child_id )
			{
				if( isset( $this->_childs_map[ $child_id ] ) )
				{
					$block = $this->_childs_map[ $child_id ];
					continue;
				}
				$block = $block->getChildHtml( $child_id );
			}
			return $block;
		}
		else
		{
			if( !isset( $this->_childs_map[ $id ] ) || empty( $this->_childs_map[ $id ] ) )
			{
				$message = "La definition du Block '$id' est manquante";
				Debug::trace( $message, Debug::DEBUG );
				return false;
			}
			else
			{	
				$block = $this->_childs_map[ $id ];
// 				unset( $this->_childs_map[ $id ] );
				$block->render();
				return $block;
			}
		} 
	}
	
	public function render()
	{
		$this->__setUp();
		//{region Block::Render
		if( isset( $this->_template ) && is_string( $this->_template ) )
		{
			$file_path = $this->getTemplateFile( $this->_template );
			if( !empty( $file_path ) )
			{	
				if( $this->_is_debuggable )
				{
					$debug_output = "<div class='template-path-debug'>";
						$debug_output .= "<div class='inner clearfix'>";
							$debug_output .= "<span class='template-path-name f-left'>$file_path</span>";
							$debug_output .= "<span class='block-id-name f-right'>".$this->_id."</span>";
						$debug_output .= "</div>";
					print $debug_output;
				}
				require $file_path;
				if( $this->isAsynchronous() ) $this->ajax();
				if( $this->_is_debuggable ) print "</div>";
			}
			else
			{
				$message = "Erreur de chargement du template '$this->_template' pour le block '$this->_id'";
				Debug::trace( $message, Debug::WARN );
			}
		}
		else
		{
			//@TODO si la vue n'a pas de template
			if( !isset( $this->_template ) || is_null( $this->_template ) )
			{
			    $message = "Le block '$this->_id' n'a pas de template associe";
			    Debug::trace( $message, Debug::WARN );
			}
		}
		//}region Block::Render
		$this->__tearDown();
		return $this;
	}
	
	/**
	 * Renvoi sur le parent les methodes
	 * Non definies sur le block
	 * 
	 * Les methodes remontent jusqu'a l'ApplicationMediator
	 * Parent du block Root
	 * 
	 * Les methodes anonymes en get sont autorisees
	 * Les methodes anonymes en set ne sont pas autorisees
	 * 
	 * @see \Bluemagic\Core\Object::__call()
	 */
	public function __call( $method, $args )
    {
    	if( substr( $method, 0, 3 ) === "set" )
    	{
    		$prop_name = substr( $method, 3 );
    		if( isset( $this->_set_data[ $prop_name ] ) )
    		{
	    		$message = "La propriete '$prop_name' existe deja sur le block '".$this->getClassName()."' ";
				Debug::trace( $message, Debug::DEBUG );
				return false;
    		}
    		else $this->_set_data[ $prop_name ] = isset( $args[ 0 ] ) ? $args[ 0 ] : null;
    		return $this;
    	}
    	else
    	{
	    	$message = "AbstractBlock::__call( '$method' ) -> BlocksMediator";
			Debug::trace( $message, Debug::DEBUG );
	    	$param_arr = ( !is_array( $args ) ? ( ( is_null( $args ) || empty( $args ) || !isset( $args ) ) ? array() : array( $args ) ) : $args );
	    	return call_user_func_array( array( $this->_parent, $method ), $param_arr );
    	}
    }
}