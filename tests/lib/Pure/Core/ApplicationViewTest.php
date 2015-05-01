<?php
namespace Pure\Core;

use PHPUnit_Framework_TestCase;
use Pure\Core\ApplicationView;

class ApplicationViewTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	public function testRedirectToError()
	{
		$this->markTestIncomplete();
	}

	public function testRedirectToNotFoundError()
	{
		$this->markTestIncomplete();
	}

	public function testRedirectToRestrictedError()
	{
		$this->markTestIncomplete();
	}

	public function testRedirectTo()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne un lien HTML
	 * 
	 * @param string $view
	 * @param string $layout
	 * @param string $action
	 * @param string $params
	 * @param string $output
	 * @return Ambigous <string, boolean, multitype:>
	 */
	public function testGetLink()
	{
		$this->markTestIncomplete();
	}

	public function testGetCurrentLink()
	{
		$this->markTestIncomplete();
	}

	public function testGetCurrentURL()
	{
		$this->markTestIncomplete();
	}

	public function testGetBaseURL()
	{
		$this->markTestIncomplete();
	}

	public function testGetCurrentRequest()
	{
		$this->markTestIncomplete();
	}

	public function testGetCurrentView()
	{
		$this->markTestIncomplete();
	}

	public function testGetCurrentLayout()
	{
		$this->markTestIncomplete();
	}

	public function testGetCurrentAction()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Les methodes appellees depuis les blocks ou un controller
	 * Remontent sur l'instance de Pure
	 * 
	 * @param string $method
	 * @param array $args
	 * @return mixed
	 */
	public function test__call()
	{
		$this->markTestIncomplete();
	}

	function tearDown()
	{
	}

}
