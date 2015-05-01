<?php
namespace Bluemagic\Abstracts;


use Exception;
use ReflectionClass;
use ReflectionMethod;

use Bluemagic\Core\Debug;
use Bluemagic\Utils\Normalizer;
use Bluemagic\Helpers\DomHelper;

use Bluemagic\Inputs\Input;
use Bluemagic\Inputs\ReadOnly;
use Bluemagic\Inputs\Password;

class AbstractForm
{
	// Private
	private $_id;
	private $_action;
	private $_method;
	private $_ecnType;
	private $_elements;
	private $_decorators;
	private $_form_errors;
	private $_elementsType;
	private $_elementsTypeMap;
	// Const
	const IS_SUBMITTED = "is_submitted";
	//
	const FILE_TYPE = "file";
	const INPUT_TYPE = "text";
	const EMAIL_TYPE = "email";
	const SELECT_TYPE = "select";
	const HIDDEN_TYPE = "hidden";
	const SUBMIT_TYPE = "submit";
	const CANCEL_TYPE = "cancel";
	const BUTTON_TYPE = "button";
	const TEXTAREA_TYPE = "textarea";
	const CHECKBOX_TYPE = "checkbox";
	const READ_ONLY_TYPE = "readonly";
	const CLONABLE_GROUP = "clonable";
	const PASSWORD_TYPE = "password";
	const DATEPICKER_TYPE = "datepicker";
	/** */
	function __construct()
	{
		$this->_elements = array();
		$this->_decorators = array();
		$this->_elementsType = array();
		$this->_elementsTypeMap = array();
		//
		$this->_action = "";
		$this->_method = "post";
		$this->_id = "abstract-form";
		$this->_form_errors = array();
		$this->_encType = "application/x-www-form-urlencoded";
		return $this;
	}
	
	public function hasErrors()
	{
		return !empty( $this->_form_errors );
	}
	
	public function build()
	{
		return $this;
	}
	
	/**
	 * Verifie que les elements d'un formulaire soit valides
	 * 
	 * @param array $params
	 */
	public function validate( $params )
	{
		$elements = $this->_elements;
		foreach( $elements as $element )
		{
			if( $element->isRequired() )
			{
				$id = $element->getId();
				$isset = array_key_exists( $id, $params );
				if( $isset )
				{
					$type = $element->getType();
					switch( $type )
					{
						case self::READ_ONLY_TYPE:
							break;
						case self::PASSWORD_TYPE:
							break;
						case self::INPUT_TYPE:
							$value = trim( $params[ $id ] );
							if( empty( $value ) ) return false;
							break;
					}
				}else return false;
			}
		}
		return true;
	}
	
	public function addError( $element )
	{
		arra_push( $this->_form_errors, $element );
	}
	
	
	/**
	 * Fabrique des elements
	 * 
	 * @param		$pType string
	 * @param		$pLabel string - Label de l'input
	 * @return		AbstractInput
	 */
	public function createElement( $pId, $pType )
	{
		switch( $pType )
		{
			case self::READ_ONLY_TYPE:
				return new ReadOnly( $pId, $pType );
			case self::PASSWORD_TYPE:
				return new Password( $pId, $pType );
			default:
				return new Input( $pId, $pType );
		}
	}
	
	public function hydrateWithJSon( $object )
	{
		if( is_string( $object ) ) $object = json_decode( $object );
		foreach( $object as $key=>$value )
		{
			$id = strtolower( $key );
			if( !$this->hasElement( $id ) || ( $id == "submitted" ) ) continue;
			$this->getElementById( $id )->setValue( $value );
		}
		return $this;
	}
	
	/**
	 * @TODO iteration a travers les noeuds type #text pas terrible, faire mieux.
	 * 
	 * @param DomDocument $document
	 */
	public function hydrateWithXML( $document )
	{
		$root_node = $document->firstChild;
		$childs = $root_node->childNodes;
		foreach( $childs as $node )
		{
			$id = DomHelper::getNodeAttr( $node, "id" );
			if( $id && ( $id != "submitted" ) )
			{
				if( !$this->hasElement( $id ) ) continue;
				$value = trim( $node->nodeValue );
				$this->getElementById( $id )->setValue( $value );
			}
		}
	}
	
	public function hydrateWithArray( $array )
	{
		$array = json_encode( $array );
		return $this->hydrateWithJSon( $array );
	}
	
	public function hydrateWithObject( $object )
	{
		$array = $object->toArray();
		return $this->hydrateWithJSon( $array );
	}
	
	public function hydrateWithCookie( $object )
	{
		$decoded = json_decode( $object );
		return $this->hydrateWithJSon( $decoded );
	}
	
	/*
	public function hydrateWithEntity( $pEntity )
	{
	    $input = $this->createElement( "id", AbstractForm::HIDDEN_TYPE ); // @TODO ok peut mieux faire
		$this->addElement( $input );
		
		$reflector = new ReflectionClass( $pEntity );
		$className = $reflector->getName();
		$methods = $reflector->getMethods( ReflectionMethod::IS_PUBLIC );
		//
		foreach( $this->getElements() as $element )
		{
			$id = $element->getId();
			$type = $element->getType();
			$camel = Normalizer::__camel( $id, "_" );
			$method = "get".$camel;
			$hasMethod = method_exists( $className, $method );
			if( $hasMethod )
			{
				$funcReflector = new ReflectionMethod( $className, $method );
				$value = $funcReflector->invoke( $pEntity );
				$value = trim( $value );
				if( ( $value == 1 ) && ( $type == AbstractForm::CHECKBOX_TYPE ) ) $element->checked();
				else $element->setValue( $value );
			} 	
		}
		return $this;
	}
	*/
	
	/**
	 * Ajoute un element au formulaire
	 * 
	 * @param $pElement AbstractInput
	 * @return	 AbstractInput
	 */
	public function addElement( Input $pElement )
	{
		$id =  $pElement->getId();
		$type = $pElement->getType();
		//
		if( !isset( $this->_elementsTypeMap[ $id ] ) ) $this->_elementsTypeMap[ $id ] = $pElement;
		else return new Exception( "L'element est deja present dans la pile" );
		//
		if( isset( $this->_elementsType[ $type ] ) )
		{
			if( is_array( isset( $this->_elementsType[ $type ] ) ) ) $this->_elementsType[ $type ][ $id ] = $pElement;
			else $this->_elementsType[ $type ] = array( $id=>$pElement ); 	
		}else $this->_elementsType[ $type ] = array( $id=>$pElement );
		//
		array_push( $this->_elements, $pElement );
		return $pElement;
	}
	
	public function hasElement( $pId )
	{
		return  ( isset( $this->_elementsTypeMap[ $pId ] ) );
	}
    
	/**
	 * Retourne les elements
	 */
	public function getElementById( $pId )
	{
		if( isset( $this->_elementsTypeMap[ $pId ] ) ) return $this->_elementsTypeMap[ $pId ];
		else return false;
	}
	public function getElementsByType( $pType )
	{
		if( isset( $this->_elementsType[ $pType ] ) ) return $this->_elementsType[ $pType ];
		else return false;
	}
	public function getElements() { return  $this->_elements; }
	public function getElement( $pId ){ return $this->getElementById( $pId ); }
//{region Getters & Setters
	public function getId(){ return $this->_id; }
	public function setId( $pValue ){ $this->_id = $pValue; return $this; }
	public function getAction(){ return $this->_action; }
	public function setAction( $pValue ){ $this->_action = $pValue; return $this; }	
	public function getMethod(){  return $this->_method; }
	public function setMethod( $pValue ){  $this->_method = $pValue; return $this; }	
	public function getEnctype(){  return $this->_encType; }
	public function setEnctype( $pValue ){  $this->_encType = $pValue; return $this; }
}