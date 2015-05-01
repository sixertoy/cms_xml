<?php
namespace Pure\Patterns\Proxies;

use PHPUnit_Framework_TestCase;
use Pure\Patterns\Proxies\LayoutProxy;

class LayoutProxyTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	public function testPrepareLoader()
	{
		$this->markTestIncomplete();
	}

	public function testLoadPageLayout()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne le nom du layout de l'application
	 * 
	 * @param unknown $layout_name
	 * @param unknown $action_name
	 * @return string
	 */
	public function testSetApplicationLayoutName()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Charge le 'default' layout
	 * Charge le 'controller' layout
	 * Recupere la classe du controller par defaut
	 * Recupere l'action par defaut
	 * Definie le nom du module pour la surcharge
	 */
	public function testPrepareLayouts()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Prepare le layout de l'application
	 * Add, Update, Remove du layout par defaut
	 * 
	 * Cree le layout qui sera utilise par l'application est mis en cache
	 * Recupere le noeud par defaut
	 * Le charge dans un nouveau Layout
	 * Met a jour le layout avec le layout de la vue est son module d'action
	 * 
	 * @param string $module
	 */
	public function testPrepareApplicationLayout()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne l'action par defaut definie par le layout de surcharge
	 * 
	 * @return string 
	 */
	public function testGetLayoutAction()
	{
		$this->markTestIncomplete();
	}

	/**
	 * @return string
	 */
	public function testGetLayoutPackage()
	{
		$this->markTestIncomplete();
	}

	/**
	 * @return string
	 */
	public function testGetLayoutController()
	{
		$this->markTestIncomplete();
	}

	/**
	 * @return string
	 */
	public function testGetLayoutModuleName()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne le layout de la page courante
	 * @return Pure\Core\Layout
	 */
	public function testGetPageLayout()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne le layout d'override de la page courante
	 * @return Pure\Core\Layout
	 */
	public function testGetOverrideLayout()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne le layout de l'application
	 * @return Pure\Core\Layout
	 */
	public function testGetApplicationLayout()
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
