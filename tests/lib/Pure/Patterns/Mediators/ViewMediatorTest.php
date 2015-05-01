<?php
namespace Pure\Patterns\Mediators;

use PHPUnit_Framework_TestCase;
use Pure\Patterns\Mediators\ViewMediator;

class ViewMediatorTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	public function testPrepareTemplate()
	{
		$this->markTestIncomplete();
	}

	public function testRender()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Prepare la loader des layouts
	 * 
	 * @param array $fallbacks
	 * @return boolean
	 */
	public function testPrepareRessourcesLoader()
	{
		$this->markTestIncomplete();
	}

	public function testGetTemplateFile()
	{
		$this->markTestIncomplete();
	}

	public function testGetStylesheetFile()
	{
		$this->markTestIncomplete();
	}

	public function testGetScriptFile()
	{
		$this->markTestIncomplete();
	}

	public function testGetBlockById()
	{
		$this->markTestIncomplete();
	}

	public function testGetHelper()
	{
		$this->markTestIncomplete();
	}

	public function test__call()
	{
		$this->markTestIncomplete();
	}

	/**
   * Get the name of the <code>Mediator</code>.
   * <P>
   * Override in subclass!</P>
   */
	public function testGetMediatorName()
	{
		$this->markTestIncomplete();
	}

	/**
   * Get the <code>Mediator</code>'s view component.
   */
	public function testGetViewComponent()
	{
		$this->markTestIncomplete();
	}

	public function testSetViewComponent()
	{
		$this->markTestIncomplete();
	}

	/**
   * List the <code>INotification</code> names this
   * <code>Mediator</code> is interested in being notified of.
   * 
   * @return Array the list of <code>INotification</code> names 
   */
	public function testListNotificationInterests()
	{
		$this->markTestIncomplete();
	}

	/**
   * Handle <code>INotification</code>s.
   * 
   * <P>
   * Typically this will be handled in a switch statement,
   * with one 'case' entry per <code>INotification</code>
   * the <code>Mediator</code> is interested in.
   */
	public function testHandleNotification()
	{
		$this->markTestIncomplete();
	}

	/**
   * Called when the View registers a Mediator.
   */
	public function testOnRegister()
	{
		$this->markTestIncomplete();
	}

	/**
   * Called when the View removes a Mediator.
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
