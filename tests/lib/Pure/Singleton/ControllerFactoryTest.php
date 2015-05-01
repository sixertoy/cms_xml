<?php
namespace Pure\Singleton;

use PHPUnit_Framework_TestCase;
use Pure\Singleton\ControllerFactory;

class ControllerFactoryTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * @TODO Verifier qu'il s'agit d'une intance de IController
	 * 
	 * @param string $class_name
	 * @param string $action
	 * @return boolean
	 */
	public function testHasAction()
	{
		$this->markTestIncomplete();
	}

	/**
	 * 
	 * @param object $instance
	 * @param string $action
	 * @param string $args
	 */
	public function testExecute()
	{
		$this->markTestIncomplete();
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
