<?php
namespace Bluemagic\Singleton;

use Bluemagic\Core\Object;

class CookieFactory
{
	
	static private $_cookies = array();
	
	static public function add( $name, $value, $expire=0, $path="/", $httpOnly=true )
	{
		$expire = ( $expire > 0 ) ? ( time() - ( $expire * 60 ) ) : 0;
		self::$_cookies[ $name ] = array
		(
			"path"=>$path,
			"value"=>$value,
			"expire"=>$expire,
			"httponly"=>$httpOnly
		);
		$added = setCookie( $name, $value, $expire, $path );
		// @TODO
//		$added = setCookie( $pName, $Value, $expire, "/", ".", false, $pHttpOnly );  
		return $added;
	}
	
	static public function get( $name )
	{
		if( isset( $_COOKIE[ $name ] ) ) return $_COOKIE[ $name ];
		return false;
	}
	
	static public function deleteAll()
	{
		foreach( self::$_cookies as $name=>$value ) self::delete( $key, $value[ "path" ] );
		unset( $_COOKIE );
		return true;
	}
	
	static public function delete( $name, $path="/" )
	{
		setCookie( $name, NULL, ( time() - 3600 ), $path );
		return true;
	}
	
	static public function toObject( $json )
	{
		$object = new Object();
		return $object->jsonToObject( $json );
	}
	
}