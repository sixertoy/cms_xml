<?php
require_once( __DIR__."/../../etc/kernel/core.kernel_config.php" );

$cache_path = ROOT_PATH.DS."etc/logs/";

$iterator = new DirectoryIterator( $cache_path );

foreach( $iterator as $fileInfo )
{
    if( $fileInfo->isDot() ) continue;
    else
    {
    	$ext = "logs";
        $name = $fileInfo->getFilename();
        $file = $cache_path.$name;
        $extension = substr( $name, 0, -strlen( $ext ) );
		if( $extension == $ext ) unlink( $file );
    }
}