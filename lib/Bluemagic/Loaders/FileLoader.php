<?php
namespace Bluemagic\Loaders;

/**
 * La regle et de mettre le "/"
 * A la fin des chemins et pas au debut
 * 
 * @TODO verification de la regle
 */
class FileLoader
{

	private $_fallbacks_path;
	
	public function __construct( $fallbacks_path=false )
	{
		$this->_fallbacks_path = $fallbacks_path;
	}
	
	public function setFallBackPath( $value )
	{
		$this->_fallbacks_path = $value;
	}
	
	public function getFilePath( $file )
	{
		if( is_array( $this->_fallbacks_path ) )
		{
			foreach( $this->_fallbacks_path as $path )
			{
				$file_path = $this->_getFilePath( $file, $path );
				if( !empty( $file_path ) ) return $file_path;
			}
		}
		else return $this->_getFilePath( $file, $this->_fallbacks_path );
        return false;
	}
	
	private function _getFilePath( $file, $path )
	{
		$file_path = $path.$file;
		if( file_exists( $file_path ) ) return $file_path;
		return false;
	}
}