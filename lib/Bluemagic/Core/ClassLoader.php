<?php
namespace Bluemagic\Core;

use Bluemagic\Core\CoreConstants;

/**
 * Class Autoload
 *  
 * @author Matthieu Lassalvy
 * @since 06/12/2012
 * @version 1.0
 * @filesource Doctrine\Common\ClassLoader
 */
class ClassLoader
{
    private $_namespace;
    private $_include_path;

    const CLASS_FILE_EXTENSION = ".php";
    
    const SLASH_SPLITTER = "\\";
    const UNDERSCORE_SPLITTER = "_";
    
    static private $_loaded_classes;
    
    public function __construct( $namespace=null, $include_path=null )
    {
        $this->_namespace = $namespace;
        $this->_include_path = $include_path;
    }
    
    public function register(){ spl_autoload_register( array( $this, "loadClass" ) ); }
    public function unregister(){ spl_autoload_unregister( array( $this, "loadClass" ) ); }
    
    /**
     * Charge une classe depuis le spl_autoload_register
     * 
     * @param string $class_name
     * @return boolean
     */
    public function loadClass( $class_name )
    {
    	if( !defined( "DS" ) ) define( "DS", DIRECTORY_SEPARATOR );
    	$is_slashed = ( strpos( $class_name, $this->_namespace.self::SLASH_SPLITTER ) !== false );
    	$is_underscored = ( strpos( $class_name, $this->_namespace.self::UNDERSCORE_SPLITTER ) !== false );
    	if( !$is_slashed && !$is_underscored ) return false;
    	if( $is_underscored )
        {
	        $file = self::_getFilenameUnderscored( $this->_include_path, $class_name );
			$names = explode( "/", $file );
			$names = array_map( "ucfirst", $names );
			require implode( "/", $names );
        	return true;
        }
        if( $is_slashed )
        {   
	        $file = self::_getFilenameSplitted( $this->_include_path, $class_name );
			$names = explode( "/", $file );
			$names = array_map( "ucfirst", $names );
			require implode( "/", $names );
        	return true;
        }
    }
	
	/**
	 * Retourne le nom du fichier a charger
	 * 
	 * @param string $include_path
	 * @param string $class_name
	 */
	static private function _getFilenameSplitted( $include_path, $class_name )
	{
		if( !defined( "PS" ) ) define( "PS", PATH_SEPARATOR );
		if( !defined( "DS" ) ) define( "DS", DIRECTORY_SEPARATOR );
        $filename = ( ( $include_path !== null ) ? $include_path.DS : "" );
        $filename .= str_replace( self::SLASH_SPLITTER, DS, $class_name ); 
        $filename .= self::CLASS_FILE_EXTENSION;
        return $filename;
	}
	
	static private function _getFilenameUnderscored( $include_path, $class_name )
	{
		if( !defined( "PS" ) ) define( "PS", PATH_SEPARATOR );
		if( !defined( "DS" ) ) define( "DS", DIRECTORY_SEPARATOR );
        $filename = ( ( $include_path !== null ) ? $include_path.DS : "" );
        $filename .= str_replace( self::UNDERSCORE_SPLITTER, DS, $class_name ); 
        $filename .= self::CLASS_FILE_EXTENSION;
        return $filename;
	}
	
	static public function _getFilename()
	{
		
	}
	
    /**
     * Verifie l'existence du fichier d'une classe
     * 
     * @param string $class_name
     * @return boolean
     */
	static public function classExists( $class_name )
	{
		$include_path = explode( PS, ini_get( "include_path" ) );
		foreach( $include_path as $path )
		{
			$filename = self::_getFilenameSplitted( $path, $class_name );
			if( file_exists( $filename ) ) return true;
		}
		if( file_exists( $class_name ) ) return true;
		return false;
	}
	
}