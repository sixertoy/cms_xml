<?php
namespace Pure\Abstracts;

use Bluemagic\Core\ClassLoader;

class AbstractAction
{
	
	private $_controller;
	
	const NAME = "AbstractAction";
	const PACKAGE_NAME = "Pure\Abstracts\AbstractAction";
	
	public function __construct( $controller )
	{
		$this->_controller = $controller;
	}
	
	public function __setUp( $is_ajax, $request )
	{
	    return $this;
	}
	
	public function __tearDown( $is_ajax, $request )
	{
	    return $this;
	}
	
	/**
	 * 
	 */
	protected function sendResult( $params )
	{
		$json = json_encode( $params );
		die( $json );
	}
	
	/**
	 * 
	 */
	protected function sendTrueResult()
	{
		$params = array( "result"=>"true" );
		return $this->sendResult( $params );
	}

	/**
	 *
	 */
	protected function sendFalseResult( $message )
	{
		$params = array( "result"=>"false", "message"=>$message );
		return $this->sendResult( $params );
	}
	
	/**
	 * Verifie si la requete a ete soumise
	 * Par le biais d'un form contenant un input hidden
	 */
	public function isAjaxSuccess( $request )
	{
		if( $request->get()->hasProperty( AbstractAsynchronous::ASYNC_REQUEST_RESPONSE ) )
		{
			return ( (bool) $request->get()->getData( AbstractAsynchronous::ASYNC_REQUEST_RESPONSE ) );
		}
		else return false;
	}
	
	public function execute( $request )
	{
        return $this;
	}
	
	protected function getController( $name=false )
	{
		return $this->_controller;
	}
	
	public function getClassName()
    {
    	$exploded = explode( ClassLoader::CLASS_NAME_SPLITTER, $this->getFullClassName() );
    	return $exploded[ count( $exploded ) - 1 ];
    }
    
    // @TODO Retourne le nom et le namespace de la classe
    public function getFullClassName()
    {
    	return self::PACKAGE_NAME;
    }
	
}