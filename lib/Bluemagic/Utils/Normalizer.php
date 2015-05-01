<?php
namespace Bluemagic\Utils;

class Normalizer
{
	static public function __pointify( $name, $token="\\" )
	{
		$items = explode( $token, $name );
		array_map( "strtolower", $items );
		return implode( $items, "." );
	}
	
	static public function __backslash( $id, $token="." )
	{
        $items = explode( $token, $id );
        array_map( "strtoupper", $items );
        return implode( $items, "\\" );
    }
	
	static public function __camel( $pValue, $pToken )
	{
		$count = substr_count( $pValue, $pToken );
		if( $count <= 0 ) return ucFirst( $pValue );
		$result = strtok( $pValue, $pToken );
		$result = ucfirst( $result );
		for( $i = 0; $i < $count; $i++ )
		{
			$temp = strtok( $pToken );
			$result .= ucfirst( $temp ); 	
		}
		return $result;
	}
	
	static public function __shortId( $pId )
	{
		$ids = explode( ".", $pId );
		$id = $ids[ count( $ids ) - 1 ];
		return $id;
	}
	
}
