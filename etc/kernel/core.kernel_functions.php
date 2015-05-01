<?php
/*********************************************************************************************************************
 * Variables globales utlisees dans les partials
 * 
 * @deprecated smarty -> Instance du moteur de template
 * @deprecated $form_elements -> tableau des elements d'un form recuperable dans un partials
 * 
********************************************************************************************************************/
// @deprecated global $form_elements, $smarty, $ajax_url;
global $dev_core_debug, $page_load_start_at, $page_load_time;

/****************************************************************************************************************************
/* Notes *******************************************************************************************************************
 * 
 * Le chemin du fichier de configuration est defini dans la classe Pure
 * Certains appel de function qui echoue sur un block Remonte jusqu'a l'ApplicationView
 * Certains appel de function qui echoue sur un block Remonte jusqu'a l'ApplicationMediator
 */
/*****************************************************************************************************************************/
// Avant tout code
function __pure_start()
{
	global $page_load_start_at, $dev_core_debug;
	if( $dev_core_debug )
	{
		xdebug_start_code_coverage();
		$page_load_start_at = microtime( true );
	}
}
// Apres tout code
function __pure_shutdown()
{
	global $dev_core_debug, $page_load_start_at, $page_load_time;
	if( $dev_core_debug )
	{
		$end_at = microtime( true );
		$page_load_time = ( $end_at - $page_load_start_at );
		$ouput = "<div id='kernel_load_time' style='visibility:hidden;display:none;'>";
		$ouput .= sprintf( "%0.3f", $page_load_time );
		$ouput .= "</div>";
		print( $ouput );
		xdebug_stop_code_coverage();
	}
}
//register_shutdown_function( "__pure_shutdown" );

/****************************************************************************************************************************
 ************ Variables globales utlisees dans les partials ***************************************************************** 
 * 
 * core_debug -> Active/Desactive le temps de chargement de la page
 * page_load_time ->Variable contenant la valeur du temps en total de chargement de l'application
 * page_load_start_at -> Variable contenant la valeur du temps en debut de chargement de l'application
 */
/*****************************************************************************************************************************/
$dev_core_debug = true;

/*********************************************************************************************************************/
/* Classes necessaires au demarrage de l'application */
/*********************************************************************************************************************/
require_once( LIBRARY_PATH."/Bluemagic/BootStrap.php" );
require_once( LIBRARY_PATH."/Smarty/Smarty.php" );
require_once( APPLICATION_PATH."/Pure.php" );