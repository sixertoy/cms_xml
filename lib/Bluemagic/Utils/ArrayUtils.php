<?php
namespace Bluemagic\Utils;

use stdClass;

class ArrayUtils
{
	
	/**
	 * Retourne la copie du tableau
	 * 
	 * @param array $array
	 * @return array:
	 */
	static public function copy( $array )
	{
		return array_merge( $array, array() );
	}
	
	/**
	 * Insere une entree a une position donnee
	 * 
	 * @param array $array
	 * @param int $position
	 * @param unknown $insert_value
	 * @return boolean
	 */
	static public function insertAt( &$array, $position, $insert_value )
	{
		$value = array( $insert_value );
		$deleted = array_splice( $array, $position, 0, $value );
		if( !empty( $deleted ) ) return false;
		else return $array;
	}
	
	static public function isLast( $key, $array )
	{
		$temp = ArrayUtils::copy( $array );
		$last = array_pop( $temp );
		return ( $last == $key );
	}
	
	/**
	 * @TODO http://www.76oner.com/flyspray/index.php?do=details&task_id=13&project=1
	 * 
	 * @param array $array
	 * @return unknown|\stdClass|boolean
	 */
	static public function toObject( $array, $change_case=true )
	{
		if( !is_array( $array ) ) return $array;
		$object = new stdClass();
    	if( is_array( $array ) && count( $array ) > 0 )
    	{
      		foreach( $array as $name=>$value )
      		{
      			$name = trim( $name );
         		if( $change_case ) $name = strtolower( $name );
         		if( !empty( $name ) ) $object->$name = self::toObject( $value );
      		}
      		return $object;
    	}
    	else return false;
	}
	
	/**
	 * Supprime les entrees vide dans un tableau
	 * 
	 * @param array $arr
	 * @return multitype:unknown multitype:
	 */
	static function removeEmptyEntries( $array )
	{
    	$result = array();
    	while( list( $key, $val ) = each( $array ) )
    	{
        	if( is_array( $val ) )
        	{
            	$val = self::array_remove_empty( $val );
	            // does the result array contain anything?
    	        if( count( $val )!=0 ) $result[$key] = $val;
        	}
        	else if( trim($val) != StringUtils::EMPTY_STRING ) $result[$key] = $val;
    	}
    	unset( $array );
    	return $result;
	}
	
	/**
	 * Retourne la derniére cle d'un tableau assoc.
	 */
	static public function lastKey( $array )
	{
		$result = array();
		$result = array_merge( $result, $array );
		end( $result );	
		return key( $result );
	}
	
	/**
	 * Retourne la derniére valeur d'un tableau
	 */
	static public function last( $array )
	{	
		return $array[ count( $array ) - 1 ];
	}
	
	/**
	 * Verifie si la cle en params
	 * Est la derniére cle d'un tableau assoc.
	 */
	static public function isLastKey( $key, $array )
	{
		return ( ArrayUtils::lastKey( $array ) == $key );
	}
	
	/**
	 * Randomize un tableau
	 */
	static public function random( $array, $length=false )
	{
		if ( !$pLength ) return shuffle( $array );
		else 
		{
			shuffle( $array );
			return array_slice( $array, 0, $length );
		}
	}
	
	/**
	 *
	 */
	static public function extract( $array, $pos )
	{
		if( count( $array ) < $pos ) return $array;
		$index = 0; 
		$result = array();
		while( $index < $pos )
		{
			array_push( $result, $array[ $index ] );
			$index++;
		}		
		return $result;
	}
    
    /**
     * Transforme la premier lettre des cles d'un tableau
     * En Lowercase
     * 
     * Ne modifie pas le tableau d'origine
     * 
     * @param array $entries
     * @return array
     */
    static public function transformUCFirstKey( $entries )
    {
    	$result = array();
    	foreach( $entries as $key=>$value ) $result[ lcfirst( $key ) ] = $value;
    	return $result;
    }
    
}