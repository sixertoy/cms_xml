<?php
namespace Bluemagic\Core;

use Bluemagic\Core\Debug;
use Bluemagic\Core\Object;
use Bluemagic\Utils\ArrayUtils;
use Bluemagic\Utils\ServerUtils;
use Bluemagic\Core\CoreConstants;
use Bluemagic\Abstracts\AbstractForm;

use Pure\Abstracts\AbstractAsynchronous;

class Request
{
	
	private $_get;
	private $_post;
	private $_request;
	
	public function __construct()
	{
		$this->_get = new Object( $_GET );
		$this->_post = new Object( $_POST );
		$this->_request = new Object( $_REQUEST );
	}
	
	public function get()
	{
		return $this->_get;
	}
	
	public function post()
	{
		return $this->_post;
	}
	
	public function request()
	{
		return $this->_request;
	}
	
	/**
	 * Retourne l'URL en cours
	 */
	public function getCurrentURL()
	{
		return ServerUtils::getCurrentURL();
	}
	
	/**
	 * Verifie si la requete a ete soumise
	 * Par le biais d'un form contenant un input hidden
	 */
	public function isSubmitted()
	{
		if( $this->post()->hasProperty( "submitted" ) )
		{
			return ( $this->post()->getSubmitted() == AbstractForm::IS_SUBMITTED );
		}
		return false;
	}
	
	public function debug()
	{ 
		$params = $this->_request;
		$message = "Request Parameters :".CoreConstants::NEW_LINE_JOKER;
		foreach( $params as $key=>$value )
		{
			$message .= $key." => ".$value.CoreConstants::NEW_LINE_JOKER;
		}
		if( empty( $params ) ) $message .= "none";
		//Debug::trace( $message, Debug::INFO );
		return true;
	}
	


	/**
	 * Retourne les HTTP parametres de la page
	 * @param string $pType
	 * @return array
	 *
	 * @see http://php.net/manual/en/reserved.variables.request.php
	 */
	/*
	private function _parseRequestParams()
	{
		$request = new stdClass();
		$request->request = $_REQUEST;
		$request->get = $this->_parseRequestParamsByType( self::GET );
		$request->post = $this->_parseRequestParamsByType( self::POST );
		return $request;
	}
	*/
	
	/**
	 * S'occupe de parser les parametres
	 * Et de les affecter a un objet de type Bluemagic\Core\Objects\Request
	 *
	 * @return \Bluemagic\Core\Object
	 * @link http://php.net/manual/en/reserved.variables.request.php
	 */
	/*
	private function _parseRequestParamsByType( $type )
	{
		$values = array();
		switch( $type )
		{
			case self::GET :
				$values = $_GET;
				break;
			case self::POST :
				$values = $_POST;
				break;
		}
		$object = new Object();
		foreach( $values as $key=>$value )
		{
			$key = strtolower( $key );
			if( in_array( $key, self::$_reserved_keys ) ) continue;
			$key = Normalizer::__camel( $key, "_" ); // @TODO le splitter correspond a quoi ?
			$method = "set".ucfirst( $key );
			call_user_func_array( array( $object, $method ), array( $value ) ); // Getter et Setter magique
		}
		return $object;
	}
	*/
	
}