<?php
namespace Pure\Patterns\Proxies;

use PHPUnit_Framework_TestCase;
use Pure\Patterns\Proxies\ControllerProxy;

class ControllerProxyTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	public function testGetCurrentControllerClassName()
	{
		$this->markTestIncomplete();
	}

	public function testGetCurrentController()
	{
		$this->markTestIncomplete();
	}

	public function testGetManager()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Affecte le controller qui sera utilise pour la vue principale
	 * 
	 * @param string $package
	 * @param string $view
	 * @param string $layout
	 * @return boolean
	 * 
	 * $view_name, $package_name, $controller_name
	 * 
	 */
	public function testSetCurrentController()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Affecte l'action qui sera appelle sur le controller
	 * 
	 * @param string $action
	 * @return boolean
	 */
	public function testSetAction()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne l'instance du controller dans la map
	 * Sinon cree un nouveau controller
	 * 
	 * @param string $class_name
	 * @param array $arguments
	 */
	public function testGetControllerById()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Le controller execute l'action __setUp et __tearDown
	 * 
	 * @TODO Verifier si le controller herite de la classe AbstractsController
	 * 
	 * @param array $arguments
	 */
	public function testExecuteAction()
	{
		$this->markTestIncomplete();
	}

	public function test__call()
	{
		$this->markTestIncomplete();
	}

	/**
   * Get the proxy name
   */
	public function testGetProxyName()
	{
		$this->markTestIncomplete();
	}

	/**
   * Set the data object
   */
	public function testSetData()
	{
		$this->markTestIncomplete();
	}

	/**
   * Get the data object
   */
	public function testGetData()
	{
		$this->markTestIncomplete();
	}

	/**
   * Called when the Model registers a Proxy.
   */
	public function testOnRegister()
	{
		$this->markTestIncomplete();
	}

	/**
   * Called when the Model removes a Proxy.
   */
	public function testOnRemove()
	{
		$this->markTestIncomplete();
	}

	public function testSendNotification()
	{
		$this->markTestIncomplete();
	}

	function tearDown()
	{
	}

}
