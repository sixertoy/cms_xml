<?php
namespace Bluemagic\Utils;
/*
 * Classe utilitaire nom de domaine.
 * http://fr.php.net/manual/fr/reserved.variables.server.php
 * http://fr.php.net/manual/fr/language.constants.predefined.php
 * 
 * $_SERVER[ 'SERVER_ADDR' ]
 * -> L'adresse IP du serveur sous lequel le script courant est en train d'etre execute.
 * 
 * $_SERVER[ 'DOCUMENT_ROOT' ]
 * -> La racine sous laquelle le script courant est ex�cut�, comme d�fini dans la configuration du serveur.
 * 
 * $_SERVER[ 'HTTP_REFERER' ]
 * -> L'adresse de la page (si elle existe) qui a conduit le client � la page courante.
 * 
 * $_SERVER[ 'SCRIPT_NAME' ]
 * -> Contient le nom du script courant.
 * 
 * $_SERVER[ 'SCRIPT_FILENAME' ]
 * -> Le chemin absolu vers le fichier contenant le script en cours d'ex�cution.
 * 
 * $_SERVER[ 'REMOTE_ADDR' ]
 * -> L'adresse IP du client qui demande la page courante.
 * 
 * $_SERVER[ 'PHP_SELF' ]
 * -> Le nom du fichier du script en cours d'ex�cution, par rapport � la racine web.
 * 
 * $_SERVER[ 'SERVER_NAME' ]
 * -> Le nom du serveur h�te qui ex�cute le script suivant. Si le script est ex�cut� sur un h�te virtuel, ce sera la valeur d�finie pour cet h�te virtuel.
 * 
 * 
 */
class ServerUtils {
	/** */
	static public function isLocalhost(){ return ( self::getRefererName() == "localhost" ); }
	/** Retourne la racine du server */
	static public function getServerRoot(){ return $_SERVER[ "DOCUMENT_ROOT" ]; }
	/** Retourne le nom du serveur */
	static public function getRefererName() { return $_SERVER[ "SERVER_NAME" ]; }
	/** Retourne l'ip serveur */
	static public function getRefererIP() { return $_SERVER[ "SERVER_ADDR" ]; }
	/** Retourne l'ip serveur */
	static public function getCurrentPage()
	{
		$names = explode( "/", $_SERVER[ 'PHP_SELF' ] );
		return $names[ count( $names ) - 1 ];
	}
	
	/**
	 * Retourne l'URL de la page en cours
	 * @return string
	 */
	static public function getCurrentURL()
	{
 		$page_url = "http";
 		if( isset( $_SERVER[ "HTTPS" ] ) && ( $_SERVER[ "HTTPS" ] == "on" ) ) $page_url .= "s";
 		$page_url .= "://";
 		if( $_SERVER[ "SERVER_PORT" ] != "80" ) $page_url .= self::getRefererName().":".$_SERVER[ "SERVER_PORT" ].$_SERVER[ "REQUEST_URI" ];
 		else $page_url .= self::getRefererName().$_SERVER[ "REQUEST_URI" ];
 		return $page_url;
	}
}
?>