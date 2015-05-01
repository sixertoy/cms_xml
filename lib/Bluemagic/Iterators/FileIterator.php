<?php
namespace Bluemagic\Iterators;

use DirectoryIterator;

class FileIterator
{
    
    /**
     * Retourne les fichiers de classes
     * 
     * @param string $path
     * @param string $filter
     * @param array $excludes
     */
    static public function getClasses( $base, $filter=false, $package="", $excludes=false )
    {
    	$pathes = $base;
        $classes = array();
        if( is_string( $base ) ) $pathes = array( $base );
    	
        foreach( $pathes as $path )
        {
        	if( empty( $package ) )
        	{
        		$result = self::_iterateThrough( $path, $filter, $package, $excludes );
        		$classes = array_merge( $result, $classes );
        	}
        	else
        	{
        		if( is_string( $package ) ) $package = array( $package );
        		foreach( $package as $pkg )
        		{
        			$result = self::_iterateThrough( $path, $filter, $pkg, $excludes );
        			$classes = array_merge( $result, $classes );	
        		} 
        	}
        }
        return $classes;
    }
    
    
    static private function _iterateThrough( $base, $filter, $package, $excludes )
    {
        $classes = array();
        $pack = ( empty( $package ) ) ? $base : ( $base.DS.$package );
		foreach( new DirectoryIterator( $pack ) as $fileInfo )
		{
            $name = $fileInfo->getFilename();

			if( $fileInfo->isDot() ) continue;
			elseif( $fileInfo->isDir() )
			{
			    if( is_array( $excludes ) && !in_array( $name, $excludes ) ) continue;
                $sub_package = $package.DS.$name;
                $temp_result = self::_iterateThrough( $base, $filter, $sub_package, $excludes );
                $classes = array_merge( $temp_result, $classes );
			}
			else
			{
            	if( $fileInfo->getExtension() !== "php" ) continue;
			    $class = $package.DS.$name;
            		    
				if( ( $filter != false ) )
				{
					if( strpos( $name, $filter ) !== false )
					{
                		$class = substr( $class, 0, -4 ); // Supprime l'extension de fichier
                		$classes[] = $class;
					}
				}
				else
				{
                	$class = substr( $class, 0, -4 ); // Supprime l'extension de fichier
                	$classes[] = $class;
				}
			}
		}
    	return $classes;
    }
    
}