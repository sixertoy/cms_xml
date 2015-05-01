<?php
namespace Bluemagic\Loaders;

use Bluemagic\Helpers\DomHelper;

use DOMXPath;
use DomDocument;

use Bluemagic\Core\Crypter;
use Bluemagic\Objects\DBObject;

class DBConfigLoader
{
//{region Variables
	private $_config;
//}region Variables
//{region Public Methods

	public function getConfig()
	{
		return $this->_config;
	}
	
	/**
	 * Charge un fichier de configuration de type .mls
	 * 
	 * @param string $file
	 */
	public function load( $file, $api_key )
	{
		$crypter = new Crypter();
		$json_decoded = $crypter->load( $file, $api_key );
		$object = json_decode( $json_decoded ); 
		$this->_config = new DBObject( $object->bddhost, $object->bddname, $object->bdduser, $object->bddpassword );
		return true;
	}
	
	/**
	 * Charge un fichier de configuration de type .xml
	 * 
	 * @param string $file
	 */
	public function loadXML( $file )
	{
		if( !file_exists( $file ) ) return false;
		$document = DomHelper::newDomDocument();
		$loaded = @$document->load( $file );
		if( !$loaded ) return false;
		$this->_config = $this->_parseOptions( $document );
		return true;
	}
	
	public function loadJSON( $json )
	{
		$object = json_decode( $json );
		$this->_config = new DBObject( $object->bddhost, $object->bddname, $object->bdduser, $object->bddpassword );
		return true;
	}
	
//}region Public Methods	
//{region Helpers
//}region Helpers
//{region Private Methods
	
	private function _parseOptions( $document )
	{
		$dbuser = DomHelper::getElementById( $document, "bdduser" );
		if( $dbuser ) $dbuser = trim( $dbuser->nodeValue );
		
		$dbhost = DomHelper::getElementById( $document, "bddhost" );
		if( $dbhost ) $dbhost = trim( $dbhost->nodeValue );
		
		$dbname = DomHelper::getElementById( $document, "bddname" );
		if( $dbname ) $dbname = trim( $dbname->nodeValue );
		
		$dbpassword = DomHelper::getElementById( $document, "bddpassword" );
		if( $dbpassword ) $dbpassword = trim( $dbpassword->nodeValue );
		
		return new DBObject( $dbhost, $dbname, $dbuser, $dbpassword );
	}

	private function _loadXMLString( $value )
	{
		$document = DomHelper::newDomDocument();
		$document->loadXML( $value );
		$this->_config = $this->_parseOptions();
		return true;
	}
	
//}region Private Methods	
}