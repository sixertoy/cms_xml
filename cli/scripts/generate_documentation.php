<?php
require_once( __DIR__."/../../etc/kernel/core.kernel_config.php" );
require_once( LIBRARY_PATH.DS."Bluemagic/Bootstrap.php" );

$bootstrap = new \Bluemagic\Bootstrap( __FILE__ );


function initAutoload()
{
    $coreAutoloader = new \Bluemagic\Core\ClassLoader( "phpDocumentor" );
    $coreAutoloader->register();
}