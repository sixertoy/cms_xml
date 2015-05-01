<?php
namespace Pure\Loggers;

use Bluemagic\Core\CoreConstants;

use Bluemagic\Core\DebugMessage;

use Bluemagic\Core\Debug;

use Doctrine\DBAL\Logging\SQLLogger;

/**
 * A SQL logger that logs to the standard output using echo/var_dump.
 *
 * 
 * @link    www.doctrine-project.org
 * @since   2.0
 * @version $Revision$
 * @author  Benjamin Eberlei <kontakt@beberlei.de>
 * @author  Guilherme Blanco <guilhermeblanco@hotmail.com>
 * @author  Jonathan Wage <jonwage@gmail.com>
 * @author  Roman Borschel <roman@code-factory.org>
 */
class DoctrineLogger implements SQLLogger
{
    /**
     * {@inheritdoc}
     */
    public function startQuery( $sql, array $params=null, array $types=null )
    {
		Debug::trace( $sql, Debug::SQL );
		
        if( $params )
        {
        	$message = "";
        	foreach( $params as $value )
        	{
        		if( is_string( $value ) ) $message .= " / ".$value;
        	}
			Debug::trace( $message, Debug::SQL );
        }
        /*
        if( $types )
        {
        	var_dump( "DoctrineLogger::" );
        	var_dump( $types );
        }
        */
    }

    /**
     * {@inheritdoc}
     */
    public function stopQuery(){}
}
