<?php
namespace Bluemagic\Singleton;

use PHPUnit_Framework_TestCase;
use Bluemagic\Singleton\ClassFactory;

class ClassFactoryTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * Cree l'instance d'une classe 
	 * 
	 * @param string $class_name
	 * @param array $args
	 * @return object
	 */
	public function testNewInstance()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Execute une methode d'une classe cree dynamiquement
	 * 
	 * @param object $instance
	 * @param string $action
	 * @param array $args
	 * @return mixed
	 */
	public function testExecute()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Verifie si l'action est contenu dans la classe
	 * 
	 * @param string $class_name
	 * @param string $action
	 * @return boolean
	 */
	public function testHasMethod()
	{
		$this->markTestIncomplete();
	}

	function tearDown()
	{
	}

}
