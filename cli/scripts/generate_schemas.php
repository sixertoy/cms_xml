<?php
/*
 * The MIT License
 *
 * Copyright (c) 2010 Johannes Mueller <circus2(at)web.de>
 * Copyright (c) 2012 Toha <tohenk@yahoo.com>
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 * @link http://code.google.com/p/mysql-workbench-doctrine-plugin/
 * 
 */
require_once( __DIR__."/../../etc/kernel/core.kernel_config.php" );

// Chargement du fichier de configuration Doctrine
$config = parse_ini_file( APPLICATION_CONFIG_PATH.DS."pure.ini", true );
$config = $config[ "doctrine" ];

define( "DEFAULT_DIR", APPLICATION_PATH.DS."repository/core/default" );
define( "MWB_INPUT_FILE", ROOT_PATH.DS."etc/bin/pure.doctrine.models.entities.mwb" );
define( "OUTPUT_DIR", APPLICATION_PATH.DS."repository/core/".$config[ "bundle" ]."/".$config[ "namespace" ] );

/**
 * Copie les fichiers par defaut dans le dossier de sortie
 * @TODO Etendre les fichiers generes par les fichiers par defaut
 */
/*
$iterator = new DirectoryIterator( DEFAULT_DIR );
foreach( $iterator as $fileInfo )
{
	if( $fileInfo->isDot() || $fileInfo->isDir() ) continue;
	else
	{
		$dest = OUTPUT_DIR."/".$fileInfo->getFilename();
		$file = DEFAULT_DIR."/".$fileInfo->getFilename();
		copy( $file, $dest );
	}
}
*/

function autoload()
{
    require_once( LIBRARY_PATH.'/MwbExporter/SplClassLoader.php');
    $classLoader = new SplClassLoader();
    $classLoader->setIncludePath( LIBRARY_PATH );
    $classLoader->register();
    return $classLoader;
}

function output( $document, $time )
{
    if ($document) {
        echo sprintf( "<h1>%s</h1>\n", $document->getFormatter()->getTitle() );
        // show some information
        echo "<h2>Information:</h2>\n";
        echo "<ul>\n";
        echo sprintf( "<li>Filename: %s</li>\n", basename( $document->getWriter()->getStorage()->getResult() ) );
        echo sprintf( "<li>Memory usage: %0.3f MB</li>\n", ( memory_get_peak_usage( true ) / 1024 / 1024 ) );
        echo sprintf( "<li>Time: %0.3f second(s)</li>\n", $time);
        echo "</ul>\n";

        // show a simple text box with the output
        echo "<h2>Result:</h2>\n";
        echo "<textarea cols=\"100\" rows=\"50\">\n";
        echo $document->getWriter()->getStorage()->getLogs()."\n";
        echo "</textarea>\n";
    }
    else
    {
        echo "<p>Export not performed, please review your code.</p>\n";
    }
}

function export( $target, $setup = array() )
{
    try
    {
        // lets stop the time
        $start = microtime( true );
        $bootstrap = new \MwbExporter\Bootstrap();
        $formatter = $bootstrap->getFormatter( $target );
        $formatter->setup( $setup );
        $document = $bootstrap->export( $formatter, MWB_INPUT_FILE, OUTPUT_DIR, "file" );
        // show the time needed to parse the mwb file
        $end = microtime( true );
        output( $document, $end - $start );
        return $document;
        
    }
    catch( \Exception $e )
    {
        echo "<h2>Error:</h2>\n";
        echo "<textarea cols=\"100\" rows=\"5\">\n";
        echo $e->getMessage()."\n";
        echo "</textarea>\n";
    }
}

// enable autoloading of classes
autoload();

use \MwbExporter\Formatter\Doctrine2\Annotation\Formatter;

// formatter setup
$setup = array(
		Formatter::CFG_INDENTATION               => 4,
		Formatter::CFG_USE_LOGGED_STORAGE        => true,
		Formatter::CFG_MERGE_EXISTING_FILE     	 => true,
		Formatter::CFG_AUTOMATIC_REPOSITORY      => true,
		Formatter::CFG_SKIP_GETTER_SETTER        => false,
		Formatter::CFG_ANNOTATION_PREFIX         => 'ORM\\',
		Formatter::CFG_BUNDLE_NAMESPACE          => $config[ "bundle" ],
		Formatter::CFG_ENTITY_NAMESPACE          => $config[ "namespace" ],
		Formatter::CFG_FILENAME                  => '%entity%.%extension%',
		Formatter::CFG_TABLE_NAME_PREFIX       	 => $config[ "table_prefix" ],
		Formatter::CFG_REPOSITORY_NAMESPACE      => $config[ "bundle" ]."\\".$config[ "proxies_namespace" ]
);

// lets do it
export( "doctrine2-annotation" , $setup);