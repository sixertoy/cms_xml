<?php
namespace Bluemagic\Loaders;

use Bluemagic\Core\Debug;
use Bluemagic\Core\CoreConstants;
use Bluemagic\Objects\ConfigObject;

/**
 * Charge, parse et cree un objet de configuration
 * @TODO Lever des exceptions
 *
 * @author Matthieu Lassalvy
 * @since 04 12 2012
 * @version 1.0
 */
class ConfigLoader
{
	
	/**
	 * Charge les fichiers de configuration
	 * Le chemin du fichier doit etre absolu
	 * 
	 * @TODO pouvoir changer le path - APPLICATION_CONFIG_PATH
	 * @TODO verifier l'include_path sur le fopen
	 *  
	 * @param array $files
	 * @return \Bluemagic\Core\Object
	 */
	public function load( $files )
	{ 
		$entries = array();
		if( !is_array( $files ) ) $files = array( $files );
		foreach( $files as $file )
		{
			$file_path = APPLICATION_CONFIG_PATH.DS.$file.CoreConstants::INI_FILE_EXTENSION;
			$this->_checkFileExists( $file_path );
			$ini_entries = parse_ini_file( $file_path, true );
			if( !empty( $ini_entries ) && ( $ini_entries !== false ) ) $entries[ $file ] = $ini_entries;
		}
		return new ConfigObject( $entries );
	}
	
	// Verifie l'existence du fichier sur le serveur
	private function _checkFileExists( $file )
	{
		if( !file_exists( $file ) )
		{
			$message = "Impossible de charger le fichier de configuration '$file'";
			Debug::trace( $message, Debug::FATAL );
			exit();
		}
		return true;
	}
}
?>