<?php
namespace Bluemagic\PHPUnit;

use Exception;
use ReflectionClass;
use ReflectionMethod;

use Bluemagic\Core\Debug;
use Bluemagic\Utils\FileUtils;

class TestClassFactory
{
	static public function create( $classes, $ouput )
	{
		foreach( $classes as $file )
		{
			try
			{
				$slashed_name = $file;
				$slashed_name = str_replace( "/", "\\", $slashed_name );
				$slashed_name = "\\".$slashed_name;
				
				$class = new ReflectionClass( $slashed_name );
				$methods = $class->getMethods();
				if( empty( $methods ) || !$methods ) continue;
				
				$short_name = $class->getShortName();
				$ns = $class->getNamespaceName();
			
				$content = "<?php\r\n";
				$content .= "namespace ".$ns.";\r\n";
				$content .= "\r\n";
				$content .= "use PHPUnit_Framework_TestCase;\r\n";
				$content .= "use ".$class->getName().";\r\n\r\n";
				$content .= "class ".$short_name."Test extends PHPUnit_Framework_TestCase\r\n";
				$content .= "{\r\n";
				
				// Setup
				$content .= "\tfunction setUp()\r\n"; 
				$content .= "\t{\r\n";
				$content .= "\t}\r\n\r\n";
				foreach( $methods as $method )
				{
					$meth = new ReflectionMethod( $slashed_name, $method->name );
					if( $meth->isPublic() && !$meth->isConstructor() )
					{
						$javadoc = $meth->getDocComment();
						if( $javadoc ) $content .= "\t".$javadoc."\r\n";
						$content .= "\tpublic function test".ucFirst( $method->name )."()\r\n"; 
						$content .= "\t{\r\n";
						$content .= "\t\t\$this->markTestIncomplete();\r\n";
						$content .= "\t}\r\n\r\n";
					}
				}
				
				// Teardown
				$content .= "\tfunction tearDown()\r\n"; 
				$content .= "\t{\r\n";
				$content .= "\t}\r\n\r\n";
			
				$content .= "}\r\n";
				
				$ns = str_replace( "\\", "/", $ns);
				self::_createFile( $ouput, $content, $short_name, $ns );
			}
			catch( Exception $e )
			{
				$msg = "TestClassFactory::create ( ".$e->getMessage()." )";
				Debug::trace( $msg, Debug::DEBUG );
			}
		}
	}
	
	static public function _createFile( $ouput, $content, $short_name, $ns )
	{
		try
		{
			$base = $ouput.DS.$ns;
			FileUtils::createFolder( $ouput.DS.$ns, 0777, true );
			$file = $base.DS.$short_name."Test.php";
			FileUtils::createFile( $file, 0777, $content );
		}
		catch( Exception $e )
		{
			$msg = "TestClassFactory::_createFile ( ".$e->getMessage()." )";
			Debug::trace( $msg, Debug::DEBUG );
		}
	}
	
}