<?php
namespace Bluemagic\Utils;

use Exception;

class FileUtils
{
	
	/**
	 * Retourne les infos sur chemin
	 * 
	 * http://techtavern.wordpress.com/2009/04/06/regex-that-matches-path-filename-and-extension/
	 * @TODO Savoir si le fichier est lu par le serveur
	 * @param string $file_full_path 
	 * @return	 string 
	 */
	static public function getFileBase( $file_full_path )
	{
		$infos = self::getFilePathInfo( $file_full_path );
		return $infos[1];
	}
	
	/**
	 * Retourne le nom du fichier sans l'extension
	 */
	static public function getFileName( $file_full_path )
	{
		$infos = self::getFilePathInfo( $file_full_path );
		return $infos[2];
	}

	/**
	 * Retourne l'extension du fichier 
	 */
	static public function getFileExtension( $file_full_path )
	{
		$infos = self::getFilePathInfo( $file_full_path );
		return $infos[3];
	}
	
	static public function getFilePathInfo( $file_full_path )
	{
		$pattern = "#^(.*/)?(?:$|(.+?)(?:(\.[^.]*$)|$))#";
		preg_match( $pattern, $file_full_path, $matches );
		return $matches;
	}
	
	/**
	 * Cree un nouveau dossier
	 * 
	 * @param unknown $foldername
	 * @param number $chmod
	 * @param string $recursive
	 * @return boolean
	 */
	static public function createFolder( $foldername, $chmod=0750, $recursive=true )
	{
		if( !file_exists( $foldername ) )
		{
			mkdir( $foldername, $chmod, $recursive );
			return true;
		}
		return false;
	}
	
	static public function createFile( $filename, $chmod=0750, $content="" )
	{
		$handle = false;
		if( !file_exists( $filename ) )
		{
			$handle = fopen( $filename, "w+" );
			if( $handle )
			{
				if( !empty( $content ) ) fputs( $handle, $content );
				fclose( $handle );
			}
			else return false;
		}
		if( $chmod && $handle )
		{
			//if( $chmod > )
			chmod( $filename, $chmod );
		}
		return true;
	}
	
	/*
	static public function utf8_fopen_read( $fileName )
	{
		$fc = iconv( "windows-1250", "utf-8", file_get_contents( $fileName ) );
		$handle = fopen( "php://memory", "rw" );
		fwrite( $handle, $fc );
		fseek( $handle, 0 );
		return $handle;
	}
	*/
}