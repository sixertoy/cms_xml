<?php
namespace Bluemagic\Core;

use Exception;

use DOMDocument;

use Bluemagic\Utils\ArrayUtils;
use Bluemagic\Utils\StringUtils;
use Bluemagic\Core\ClassLoader;

/**
 * Object Magique
 * Les proprietes de l'objet sont setter dynamiquement
 * 
 * @author Matthieu Lassalvy
 */
class Object
{
	
    protected $_data_object = array();
    

    /**
     * By default is looking for first argument as array and assignes it as object attributes
     * This behaviour may change in child classes
     * 
     * @param	array $values 
     */
    public function __construct()
    {
        $args = func_get_args();
        if( empty( $args[ 0 ] ) ) $this->_data_object = array();
        else if( is_array( $args[ 0 ] ) ) $this->_data_object = $args[ 0 ];
        return $this;
    }
    
    /**
     * Methode magique PHP
     * Transforme un appel de methode en proprietes d'objet
     * 
     * @param unknown $pMethod
     * @param unknown $pArgs
     * @return Ambigous <NULL, multitype:>|multitype:
     */
    public function __call( $method, $args )
    {
        $message = Debug::trace( "Object::__call called for method :: $method", Debug::DEBUG );
		$name = substr( $method, 3 );
		$property = strtolower( $name );
    	$suffix = substr( $method, 0, 3 );
        switch( $suffix )
        {
            case "get":
                $result = $this->getData( $property );
        		if( is_null( $result ) )
        		{
        			$message = "Invalid method => ".$this->getClassName()."::__call( get".$name." )";
        			$message = Debug::trace( $message, Debug::ERROR );
        		}
        		return $result;
            case "set":
                return $this->setData( $property, isset( $args[ 0 ] ) ? $args[ 0 ] : null ); 
        }
    }
    
    public function __get( $key )
    {
    	return $this->getData( $key );
    }
        
    public function __set( $key, $value )
    {
    	$this->setData( $key, $value );
    }
        
    public function hasMethod( $method )
    {
		$name = substr( $method, 3 );
		$property = strtolower( $name );
    	return isset( $this->_data_object[ $property ] );
    }
    
    public function hasProperty( $property )
    {
    	return ( isset( $this->_data_object[ $property ] ) );
    }
   
	public function setData( $key, $value=null )
    {
    	$this->_data_object[ $key ] = $value;
        return $this->_data_object[ $key ];
    }
    
    public function getData( $key )
    {
    	return ( isset( $this->_data_object[ $key ] ) ? $this->_data_object[ $key ] : false );
    }
    
    /**
     * Retourne les valeurs sous forme de XML string
     * 
     * @return string
     */
    public function toXML()
    {
    	$document = new DOMDocument( "1.0", "utf-8" );
    	$document->formatOutput = true;
    	$root = $document->createElement( "data" );
    	$document->appendChild( $root );
    	foreach( $this->_data_object as $key=>$value )
    	{
    		// Item
    		$node = $document->createElement( "item" );
	    		// Id attribut
    			$attr = $document->createAttribute( "id" );
    			$id = $document->createTextNode( $key );
    			$attr->appendChild( $id );
    		$node->appendChild( $attr );
    		// Valeur
    		$cdata = $document->createCDATASection( $value );
    		$node->appendChild( $cdata );
    		$root->appendChild( $node );
    	}
    	return $document->saveXML();
    }    
    /**
     * Transforme l'objet JSON en Bluemagic\Core\Object 
     * @param string $json_string
     * @return Bluemagic\Core\Object
     */
    public function jsonToObject( $json_string )
    {
    	$decoded = json_decode( $json_string );
		foreach( $decoded as $key=>$value ) $this->setData( $key, $value );
		return $this;		
    }
    
    // Retourne l'objet sous la forme SERIALIZE
    public function toSerialized()
    {
    	return serialize( $this->_data_object );
    }
    
    // Retourne l'objet sous la forme d'un JSON
    public function toJson()
    {
    	return json_encode( $this->_data_object );
    }
    
    // Retourne l'objet sous la forme d'un ARRAY
    public function toArray()
    {
    	return $this->_data_object;
    }
    
    // Retourne le nom de la classe de l'objet
    public function getClassName()
    {
    	$class = get_class( $this );
    	$exploded = explode( ClassLoader::CLASS_NAME_SPLITTER, $class );
    	return $exploded[ count( $exploded ) - 1 ];
    }
    
    // @TODO Retourne le nom et le namespace de la classe
    public function getFullClassName()
    {
    	return get_class( $this );
    }
    
}
?>