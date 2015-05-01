<?php
namespace Bluemagic\Core;

use Bluemagic\Utils\FileUtils;

use Exception;

use Bluemagic\Core\PHPConstants;

/**
 * 
 * @author Matthieu Lassalvy
 * 
 */
class Debug
{	
	/* 1 */ const FATAL = 0; // Arrete toutes execution du script
	/* 2 */ const ERROR = 1; // Toutes les erreurs emanant d'un disfonctionnement de l'application, chargement, interpreteur XML
	/* 3 */ const WARN = 2; // Erreurs possibles mais pas bloquantes
	/* 6 */ const SQL = 3; // Toutes les information de deboggage des requetes doctrine
	/* 4 */ const INFO = 4; // Simple information de deboggage pour l'utilisateur lambda
	/* 5 */ const DEBUG = 5; // Toutes les information de deboggage
	// Order de priorite des erreurs
	static private $_types = array( "fatal", "error", "warn", "sql", "info", "debug" );
	// Stocke le type d'erreur permise a l'affichage
	static private $_debug_level = array();
	// Affecte l'affichage du layout debugger sur le hover des elements HTML
	static private $_use_layouts_debug = false;
	
// 	static private $_use_traces_debug = false;

	static private $_is_fatal = true;
	static private $_is_ajax = false;
	
	// Stocke les messages d'erreurs
	static private $_messages = array();
	
	// Fichiers de logs
	static private $_sql_file = "etc/logs/sql.log";
	static private $_infos_file = "etc/logs/infos.log";
	static private $_debug_file = "etc/logs/debug.log";
	static private $_errors_file = "etc/logs/errors.log";
	static private $_exception_file = "etc/logs/exceptions.log";
	
	static public function useAjax( $bool )
	{
		self::$_is_ajax = $bool;
	}
	
	static public function getTypes()
	{
		return self::$_types;
	}
	
	static public function getMessages()
	{
		return self::$_messages;
	}
	
	static public function setExceptionFile( $file )
	{
		self::$_exception_file = $file;
	}
	
	static public function setDebugFile( $file )
	{
		self::$_debug_file = $file;
	}
	
	static public function setInfosFile( $file )
	{
		self::$_infos_file = $file;
	}
	
	static public function setSQLFile( $file )
	{
		self::$_sql_file = $file;
	}
	
	static public function setErrorFile( $file )
	{
		self::$_errors_file = $file;
	}
	
	static public function setFatal( $value )
	{
		self::$_is_fatal = $value;
	}
	
//{region Init Methods
	
	/**
	 * Defini si les erreurs sont tracees a l'ecran
	 * 
	 * @param unknown $value
	 */
	static public function setDisplaysErrors( $bool )
	{
		ini_set( "display_errors", $bool );
	}
	
	/**
	 * Definie si les erreurs sont tracees dans un fichier de log
	 *
	 * @param unknown $value
	 */
	static public function setLogErrors( $bool )
	{
		ini_set( "log_errors", $bool );
	}
	
	/**
	 * Si l'application ne tourne pas sur l'environnement de production
	 * On efface les fichiers de logs a chaque chargement
	 * 
	 * Le fichier de debug est efface a chaque chargement
	 * 
	 */
	static public function setEnvironnement( $bool )
	{
// 		if( file_exists( self::$_infos_file ) ) unlink( self::$_infos_file );
// 		if( !$bool ) self::clearLogsFiles();
	}
	
	/**
	 * Affecte un niveau de debug pour le fichier de log
	 * Limite le niveau de dbug autorise pour l'environnement courant
	 * 
	 * Verifie si l'erreur est permise pour le debug
	 * Si l'erreur le niveau est trouve dans le tableau on l'ajoute au autorisation de debugs
	 * Si le niveau est atteint on sort de la boucle
	 * 
	 * @param string $level
	 * @return boolean
	 */
	static public function setTraceLevel( $level, $excepts=null )
	{
		foreach( self::getTypes() as $type )
		{
			$is_excepts = ( isset( $excepts ) && !is_null( $excepts ) ) ? in_array( $level, $excepts ) : false;
			if( !$is_excepts ) self::$_debug_level[] = $type;
			if( ( $type === $level ) ) return true;
		}
	}
//}region Init Methods
	
	/**
	 * @TODO Supprime les fichiers de log sur le serveur
	 * 
	 * @param boolean $clear_exceptions
	 */
	static public function clearLogsFiles( $clear_exceptions=false ){}
			
	/**
	 * Cree un debug message
	 * 
	 * Si le code d'erreur du debug message et de type Debug::FATAL
	 * Une exception est levee et l'application est stoppee
	 * 
	 * @param string $message
	 * @param object $caller
	 * @param string $errorCode
	 * 
	 * @return Bluemagic\Objects\DebugMessage
	 */
	static public function trace( $message, $level )
	{
		$infos = self::_getExtrasDebugInfos();
		$debugMessage = new DebugMessage( $message, $level, $infos[ "file" ], $infos[ "line" ] );
		
		self::_logMessage( $debugMessage ); // Ecrit les erreurs dans un fichier
		
		// Si le message est une erreur fatale on envoi une exception est stoppe l'execution de l'application
		if( $level === self::FATAL ) self::_throwNewException( $debugMessage );
		// Ajoute le message au stack pour l'envoyer sur le PureDebugger
		$codes = array();
		
		// @TODO
	    if( $level > Debug::DEBUG ) var_dump( "DBUG 2x values... @TODO FIX =>".$infos[ "file" ] );
		else $codes[] = $level;
	    foreach( $codes as $value )
	    {
		    if( !isset( self::$_messages[ $value ] ) ) self::$_messages[ $value ] = array();
            array_push( self::$_messages[ $value ], $debugMessage );
	    }
		return true;
	}
	
	/**
	 * Retourne les informations additionnelles de debug grace au backtrace
	 * 
	 * @return multitype:string
	 */
	static private function _getExtrasDebugInfos()
	{
		$infos = array( "line"=>"n/a", "file"=>"n/a" );
		$debug_infos = debug_backtrace();
		if( isset( $debug_infos[ 1 ] ) ) // 1 niveau de debug
		{
			if( isset( $debug_infos[ 1 ][ "file" ] ) ) $infos[ "file" ] = $debug_infos[ 1 ][ "file" ];
			if( isset( $debug_infos[ 1 ][ "line" ] ) ) $infos[ "line" ] = $debug_infos[ 1 ][ "line" ];
		}
		return $infos;
	}
	
	/**
	 * Envoi des exceptions utlisateurs declenchee par Debug::FATAL
	 * 
	 * @param DebugMessage $debugMessage
	 * @throws Exception
	 */
	static private function _throwNewException( $debugMessage )
	{
		if( self::$_is_fatal )
		{
			$message = $debugMessage->getMessage();
			throw new Exception( $message );
			exit();
		}
	}
	
	/**
	 * Ecrit les message de debug dans un fichier
	 * 
	 * @param Bluemagic\Core\DebugMessage $debugMessage
	 */
	static private function _logMessage( $debugMessage )
	{
		$code = $debugMessage->getLogCode();
		$message = $debugMessage->getMessage();
		if( ini_get( "log_errors") )
		{
		    // Verifie si le message a le niveau necessaire de debug
		    if( $code == Debug::FATAL )
		    {
				FileUtils::createFile( self::$_exception_file, 0777 );
		    	error_log( $message, 3, self::$_exception_file );
		    }
		    
		    if( $code == Debug::ERROR )
		    {
				FileUtils::createFile( self::$_errors_file, 0777 );
		    	error_log( $message, 3, self::$_errors_file );
		    }
		    
			if( $code != Debug::INFO )
			{
				FileUtils::createFile( self::$_infos_file, 0777 );
				error_log( $message, 3, self::$_infos_file );
			}
			
		    if( $code == Debug::SQL )
		    {
				FileUtils::createFile( self::$_sql_file, 0777 );
		    	error_log( $message, 3, self::$_sql_file );
		    }
		    
			if( $code != Debug::DEBUG )
			{
				FileUtils::createFile( self::$_debug_file, 0777 );
				error_log( $message, 3, self::$_debug_file );
			}
			
		}
		// Affiche les warning et erreurs utilisateurs
		// Les debug et info sont loggues
		// Les fatal levent des exceptions
		// Si le niveau de debug le permet
		if( ini_get( "display_errors") )
		{  
			if( self::$_is_ajax && ( ( $code == Debug::WARN ) || ( $code == Debug::ERROR ) ) )
			{
				// AbstractAsynchronous
				$json = json_encode( array( "result"=>"false", "message"=>$message ) );
				die( $json );
			}
			elseif( ( $code == Debug::WARN ) || ( $code == Debug::ERROR ) )
			{
    		    $message = "<pre class='alert-error'>".$message."</pre>";
    		    print( $message );
			}
		}
	}

	/**
	 * Définit une fonction utilisateur de gestion d'exceptions
	 * 
	 * @link http://php.net/manual/fr/function.set-exception-handler.php
	 * 
	 * @param Exception $exception
	 * @return boolean
	 */
	static public function exception_handler( $exception )
	{
		if( !ini_get( "log_errors") && !ini_get( "display_errors") ) return true;
		// Ecriture dans le fichier
		$exception_message = $exception->getMessage();
		if( ini_get( "log_errors") )
		{
			FileUtils::createFile( self::$_exception_file, 0777 );
			error_log( $exception_message."\r\n", 3, self::$_exception_file );
		}
		// Affichage utilisateur
		if( ini_get( "display_errors") )
		{ 
			if( self::$_is_ajax )
			{
				// AbstractAsynchronous
				$json = json_encode( array( "result"=>"false", "message"=>$exception_message ) );
				die( $json );
			}
			else
			{
		    	$message = "<pre class='alert-error'>";
		    	$message .= "<b>EXCEPTION</b><br>";
		    	$message .= $exception_message;
		    	$message .= "</pre>";
		    	print( $message );
			}
		}
	}
}
//{region Gestions des erreurs PHP
set_exception_handler( array( "Bluemagic\Core\Debug", "exception_handler" ) );
//}region Gestions des erreurs PHP

class DebugMessage
{

	private $_file;
	private $_line;
	private $_code;
	private $_message_body;
	
	const TEXT_OUTPUT = "text";
	const AJAX_OUTPUT = "ajax";
	const HTML_OUTPUT = "html";
	
	/**
	 * @param string $message
	 * @param string $code
	 * @param string $file
	 * @param string $line
	 */
	function __construct( $message_body, $code, $file="n/a", $line="n/a" )
	{
		$this->_file = $file;
		$this->_line = $line;
		$this->_code = $code;
		$this->_message_body = $message_body;
	}
	
    public function getFile(){ return $this->_file; }
	
	public function getLine(){ return $this->_line; }
	
	public function getLogCode(){ return $this->_code; }
	
    public function getMessageBody(){ return $this->_message_body; }
	
	/**
	 * Ajoute une ligen au message
	 * 
	 * @param string $message
	 * @return boolean
	 */
	public function add( $message )
	{
		$message = trim( $message );
		if( empty( $message ) ) return false;
		$this->_message_body .= CoreConstants::NEW_LINE_JOKER.$message;
		return true;
	}
	
	public function getMessage( $output="text" )
	{
	    switch( $output )
	    {
	        case self::TEXT_OUTPUT:
	            $formatted_message = $this->_getTextOutput();
	            break;
	        case self::HTML_OUTPUT:
	            $formatted_message = $this->_getHTMLOutput(); 
	            break;
	        case self::AJAX_OUTPUT:
	            $formatted_message = $this->_getAJAXOutput(); 
	            break;
	    }
		return $formatted_message;
	}
	
	private function _getTextOutput()
	{
		$new_line = "\r\n";
		$mess = str_replace( CoreConstants::NEW_LINE_JOKER, $new_line, $this->_message_body );
		
		$message = "[".strtoupper( $this->_code )."]";
		$message .= " :: ".date( "Y-M-d H:i" );
		$message .= "\t".$this->_file.$new_line;
		$message .= "\t".$this->_line." => ".$mess.$new_line.$new_line;
		return $message;
	}
	
	private function _getHTMLOutput()
	{
		$add_class = "";
		$new_line = "<br>";
		$mess = str_replace( CoreConstants::NEW_LINE_JOKER, $new_line, $this->_message_body );
		
		// @TODO ajouter le filtre sur les messages de type simple debug
		if( strpos( $mess, "Object::__call" ) )
		{
			$add_class = "debug-msg-call";
			var_dump( strpos( $mess, "Object::__call" ) );
		}
		
		$message = "<div class='debug-message $add_class ".$this->_code."'>";
		$message .= "<i>".$this->_file." @line ".$this->_line."</i>".$new_line;
		$message .= "<span>".$mess."<span>";
		$message .= "</div>";
		return $message;
	}
	
	private function _getAJAXOutput()
	{
		$new_line = "<br>";
		$mess = str_replace( CoreConstants::NEW_LINE_JOKER, $new_line, $this->_message_body );
		
		$message = "<div class='alert-error ".$this->_code."'>";
		$message .= "<ul><li>".$mess."<li></ul>";
		$message .= "</div>";
		return $message;
	}

}