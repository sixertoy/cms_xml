<?php
namespace Pure\Patterns\Proxies;

use PHPUnit_Framework_TestCase;
use Pure\Patterns\Proxies\ApplicationProxy;

class ApplicationProxyTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	public function testPrepareSession()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne la cle secrete d'API
	 * 
	 * @return string
	 */
	public function testGetApplicationKey()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne le mode d'environnement de l'application
	 */
	public function testIsProductionMode()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Verifie que l'application est installee
	 * Si le fichier XML temporaire des informations de BDD n'est pas present dans le dossier install
	 * 
	 * @return boolean
	 */
	public function testIsApplicationReady()
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
