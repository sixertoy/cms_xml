<?php
namespace Pure\Patterns\Mediators;

use PHPUnit_Framework_TestCase;
use Pure\Patterns\Mediators\BlocksMediator;

class BlocksMediatorTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * 
	 * @param \Pure\Core\Root $block
	 */
	public function testOutput()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Construction de la vue
	 * 
	 * @param \Pure\Abstracts\AbstractLayout $layout
	 */
	public function testPrepareView()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Recupere un block par son ID
	 * 
	 * @param unknown $block_id
	 * @param string $blocks
	 * @return unknown
	 */
	public function testGetBlockById()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Les methodes appellees depuis les templates phtml
	 * Remontent sur ApplicationFacade
	 *
	 * @param string $method
	 * @param array $args
	 * @return mixed
	 */
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
