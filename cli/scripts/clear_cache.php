<?php
require_once( __DIR__."/../../etc/kernel/core.kernel_config.php" );

$iterator = new DirectoryIterator( CACHE_PATH.DS."layouts" );

foreach( $iterator as $fileInfo )
{
    if( $fileInfo->isDot() ) continue;
    else
    {
        $name = $fileInfo->getFilename();
        $file = $cache_path.$name;
        $extension = substr( $name, 0, -3 );
		if( $extension == "xml" ) unlink( $file );
    }
}