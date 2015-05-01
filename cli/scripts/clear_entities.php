<?php
require_once( __DIR__."/../../etc/kernel/core.kernel_config.php" );

$config = parse_ini_file( APPLICATION_CONFIG_PATH.DS."pure.ini", true );
$config = $config[ "doctrine" ];

$output_dir = APPLICATION_PATH.DS."repository/core/".$config[ "bundle" ]."/".$config[ "namespace" ];


$iterator = new DirectoryIterator( $output_dir );
foreach( $iterator as $fileInfo )
{
	if( $fileInfo->isDot() ) continue;
	else unlink( $output_dir.DS.$fileInfo->getFilename() );
}

$output_dir = APPLICATION_PATH.DS."repository/core/".$config[ "bundle" ]."/".$config[ "proxies_namespace" ];


$iterator = new DirectoryIterator( $output_dir );
foreach( $iterator as $fileInfo )
{
	if( $fileInfo->isDot() ) continue;
	else unlink( $output_dir.DS.$fileInfo->getFilename() );
}