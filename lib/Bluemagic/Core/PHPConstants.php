<?php
namespace Bluemagic\Core;

/**
 * 
 * @author Rose
 * 
 * @link http://php.net/manual/fr/errorfunc.constants.php
 */
class PHPConstants
{
	
	const APACHE_MOD_REWRITE = "mod_rewrite";
	const APACHE_MOD_SPELLING = "mod_spelling";
	
	/**
	 * 
	 * @param unknown $code
	 * @return string
	 */
	static public function friendlyErrorType( $code ) 
 	{ 
     	switch( $code ) 
     	{ 
			case E_ERROR: return 'E_ERROR';// 1 // 
         	case E_WARNING: return 'E_WARNING';// 2 // 
         	case E_PARSE: return 'E_PARSE';// 4 // 
         	case E_NOTICE: return 'E_NOTICE';// 8 // 
         	case E_CORE_ERROR: return 'E_CORE_ERROR';// 16 // 
         	case E_CORE_WARNING: return 'E_CORE_WARNING';// 32 // 
         	case E_CORE_ERROR: return 'E_COMPILE_ERROR';// 64 //  
         	case E_CORE_WARNING: return 'E_COMPILE_WARNING';// 128 // 
         	case E_USER_ERROR: return 'E_USER_ERROR';// 256 // 
         	case E_USER_WARNING: return 'E_USER_WARNING';// 512 // 
         	case E_USER_NOTICE: return 'E_USER_NOTICE';// 1024 // 
         	case E_STRICT: return 'E_STRICT';// 2048 // 
         	case E_RECOVERABLE_ERROR: return 'E_RECOVERABLE_ERROR';// 4096 // 
         	case E_DEPRECATED:  return 'E_DEPRECATED';// 8192 // 
         	case E_USER_DEPRECATED: return 'E_USER_DEPRECATED';// 16384 // 
     	} 
    	return ""; 
 	}
}