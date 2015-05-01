<?php
namespace Bluemagic\Abstracts;

use PureMVC\Proxy\RequestProxy;

use Bluemagic\Core\Object;
use Bluemagic\Abstracts\AbstractObject;
use Bluemagic\Singleton\ControllerFactory;

class AbstractHelper extends AbstractObject
{
    
	public function getController( $pArgs=null )
	{
		$name = $this->getControllerClassName();
		return ControllerFactory::getControllerInstance( $name, $pArgs );
	}
	
	public function  getControllerClassName()
	{
		$namespace = $this->getNamespace();
		$package = strtok( $namespace, "\\" );
		$controller = strtok( "\\" );
		$controller = $package."\\".$controller."\\".$controller."Controller";
		return $controller;
	}
}