<?php
/*********************************************************************************************************************/
/* Gestion des erreurs */
/*********************************************************************************************************************/
// ini_set( "log_errors", 1 ); // Setter dans le application.ini
// ini_set( "display_errors", 1 ); // Setter dans le application.ini
error_reporting( E_ALL | E_STRICT );
/*********************************************************************************************************************/
/* Chemin absolu de l'application */
/*********************************************************************************************************************/
define( "PS", PATH_SEPARATOR );
define( "DS", DIRECTORY_SEPARATOR );
define( "ROOT_PATH", realpath( dirname( dirname( dirname( __FILE__ ) ) ) ) );
define( "LIBRARY_PATH", ROOT_PATH.DS."lib" ); // Chemin vers les libs
define( "CACHE_PATH", ROOT_PATH.DS."cache" ); // Chemin des fichiers de cache
define( "LOCALE_PATH", ROOT_PATH.DS."locale" ); // Chemin des fichiers de locale
define( "APPLICATION_PATH", ROOT_PATH.DS."app" ); // Chemin des fichiers de l'application
define( "APPLICATION_CONFIG_PATH", ROOT_PATH.DS."etc".DS."configs" ); // Chemin des fichiers de configuration de l'application
