<?php
namespace Pure\Abstracts;

use PHPUnit_Framework_TestCase;
use Pure\Abstracts\AbstractController;

class AbstractControllerTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * Retourne si la vue contient des erreurs
	 * 
	 * @return boolean
	 */
	public function testIsReady()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne le ControllerProxy
	 * Ou un controller definie par son nom
	 * 
	 * @param string $name
	 * @return string
	 */
	public function testGetProxy()
	{
		$this->markTestIncomplete();
	}

	public function testGetEntityName()
	{
		$this->markTestIncomplete();
	}

	public function testSetEntityName()
	{
		$this->markTestIncomplete();
	}

	public function testGetLink()
	{
		$this->markTestIncomplete();
	}

	public function testSetForm()
	{
		$this->markTestIncomplete();
	}

	public function testGetForm()
	{
		$this->markTestIncomplete();
	}

	public function test__setUp()
	{
		$this->markTestIncomplete();
	}

	public function test__tearDown()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Ajout des actions du controller
	 * 
	 * @param string $name
	 * @param string $class_name
	 * @return \Pure\Abstracts\AbstractAction
	 */
	public function testRegisterAction()
	{
		$this->markTestIncomplete();
	}

	public function testRetrieveAction()
	{
		$this->markTestIncomplete();
	}

	public function testRetrieveActions()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Ajoute des message qui seront recuperes par la vue
	 */
	public function testAddNotification()
	{
		$this->markTestIncomplete();
	}

	public function testGetNotifications()
	{
		$this->markTestIncomplete();
	}

	public function testFindAll()
	{
		$this->markTestIncomplete();
	}

	public function testFindBy()
	{
		$this->markTestIncomplete();
	}

	public function testFind()
	{
		$this->markTestIncomplete();
	}

	public function testGetClassName()
	{
		$this->markTestIncomplete();
	}

	public function testGetFullClassName()
	{
		$this->markTestIncomplete();
	}

	public function testHasProperty()
	{
		$this->markTestIncomplete();
	}

	public function testGetData()
	{
		$this->markTestIncomplete();
	}

	public function test__call()
	{
		$this->markTestIncomplete();
	}

	function tearDown()
	{
	}

}
