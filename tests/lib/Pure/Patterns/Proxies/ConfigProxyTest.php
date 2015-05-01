<?php
namespace Pure\Patterns\Proxies;

use PHPUnit_Framework_TestCase;
use Pure\Patterns\Proxies\ConfigProxy;

class ConfigProxyTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * Retourne les vues definies dans le .ini
	 * 
	 * @return Bluemagic\Core\Object
	 */
	public function testGetViews()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne les vues definies dans le .ini
	 * Seules les vues qui ont besoin d'un authentification
	 * Sont retournees dans un array pour base sur le params 'name' du .ini
	 * @return array
	 */
	public function testGetRestrictedViews()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne l'objet de configuration pour la gestion des fichiers de cache
	 * @return stdClass
	 */
	public function testGetCacheConfig()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne l'objet de configuration pour la gestion du connecter
	 * @return stdClass
	 */
	public function testGetApplicationConfig()
	{
		$this->markTestIncomplete();
	}

	/**
	 * @TODO http://www.76oner.com/flyspray/index.php?do=details&task_id=13&project=1
	 * 
	 * Retourne l'objet de configuration
	 * Issu du Bluemagic\Object\ConfigObject
	 * Pour la configuration du RequestProxy
	 * @return stdClass
	 */
	public function testGetRequestConfig()
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
