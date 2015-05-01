<?php
/*****************************************************************************************/
function changeIniValue( $key, $value, $filename )
{
	$content = "";
	$file = fopen( $filename, "r+" );
	while( !feof( $file ) )
	{
		$line = fgets( $file );
		if( strpos( $line, $key."=" ) !== false ) $content .= $key."=".$value;
		else $content .= $line;
	}
	fclose( $file );
	unlink( $filename );
	
	$file = fopen( $filename, "w+" );
	fwrite( $file, $content );
	fclose( $file );

}
/*****************************************************************************************/
require_once( __DIR__."/../../etc/kernel/core.kernel_config.php" );

$file = "etc/configs/application.ini";
changeIniValue( "apikey", "false", ROOT_PATH.DS.$file );

setcookie( "pure_gps_values", NULL, time() - 3600, "/" );
unset( $_COOKIE[ "pure_gps_values" ] );

$file = "etc/kernel/connecter.mls";
if( file_exists( ROOT_PATH.DS.$file ) ) unlink( ROOT_PATH.DS.$file );

$file = "install/database.install.xml";
if( file_exists( ROOT_PATH.DS.$file ) ) unlink( ROOT_PATH.DS.$file );

$file = "install/site.install.xml";
if( file_exists( ROOT_PATH.DS.$file ) ) unlink( ROOT_PATH.DS.$file );

$file = "install/superadmin.install.xml";
if( file_exists( ROOT_PATH.DS.$file ) ) unlink( ROOT_PATH.DS.$file );

$file = "install";
if( is_dir( ROOT_PATH.DS.$file ) ) rmdir(ROOT_PATH.DS.$file );