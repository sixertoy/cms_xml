<?php
namespace Pure\Helpers;

class UserHelper
{	
	private $_user;
	private $_manager;
	private $_password;
	private $_userName;
	const ENTITY_NAME = "Doctrine\Entities\YacmsUser";
	
	public function __construct( $pEntitiesManager )
	{
		$this->_manager = $pEntitiesManager;
		$this->_repository = $this->_manager->getRepository( self::ENTITY_NAME );
	}
	
	/**
	 * Retourne un utilisateur par son login
	 * @param string $pValue
	 * @return boolean
	 */
	public function findUserByUserName( $pValue )
	{ 
		$user = $this->_repository->findOneBy( array( "login"=>$pValue ) );
		if( isset( $user ) && !is_null( $user ) ) return $user;
		return false;
	}

	public function getRequestUsername()
	{
		return ( isset( $_POST[ "username" ] ) ? $_POST[ "username" ] : false );
	}
	
	public function getRequestPassword()
	{
		return ( isset( $_POST[ "passsword" ] ) ? $_POST[ "passsword" ] : false );
	}
	
	public function getUserName(){ return $this->_userName; }
	public function setUserName( $pValue ){ $this->_userName = $pValue; }
	
	public function getPassword(){ return $this->_password; }
	public function setPassword( $pValue ){ $this->_password = md5( $pValue ); }
	
}