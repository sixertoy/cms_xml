<?php
namespace Pure\Patterns;

use PHPUnit_Framework_TestCase;
use Pure\Patterns\StartupFacade;

class StartupFacadeTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * 
	 * 
	 * @return \Pure\StartupFacade
	 */
	public function testInitialize()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Lance l'installation de l'application sur le serveur
	 * @return \Pure\StartupFacade
	 */
	public function testStartup()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Instance getter for the ApplicationFacade, this method
	 * starts the Facade.
	 */
	public function testGetInstance()
	{
		$this->markTestIncomplete();
	}

	public function testGetApplicationView()
	{
		$this->markTestIncomplete();
	}

	public function testSetApplicationView()
	{
		$this->markTestIncomplete();
	}

	/**
   * Notify <code>Observer</code>s.
   * 
   * @param notification the <code>INotification</code> to have the <code>View</code> notify <code>Observers</code> of.
   */
	public function testNotifyObservers()
	{
		$this->markTestIncomplete();
	}

	/**
   * Register an <code>ICommand</code> with the <code>Controller</code> by Notification name.
   * 
   * @param notificationName the name of the <code>INotification</code> to associate the <code>ICommand</code> with
   * @param commandClassRef a reference to the Class of the <code>ICommand</code>
   */
	public function testRegisterCommand()
	{
		$this->markTestIncomplete();
	}

	/**
   * Remove a previously registered <code>ICommand</code> to <code>INotification</code> mapping from the Controller.
   * 
   * @param notificationName the name of the <code>INotification</code> to remove the <code>ICommand</code> mapping for
  */
	public function testRemoveCommand()
	{
		$this->markTestIncomplete();
	}

	/**
   * Check if a Command is registered for a given Notification 
   * 
   * @param notificationName
   * @return whether a Command is currently registered for the given <code>notificationName</code>.
   */
	public function testHasCommand()
	{
		$this->markTestIncomplete();
	}

	/**
   * Register an <code>IProxy</code> with the <code>Model</code> by name.
   * 
   * @param proxyName the name of the <code>IProxy</code>.
   * @param proxy the <code>IProxy</code> instance to be registered with the <code>Model</code>.
   */
	public function testRegisterProxy()
	{
		$this->markTestIncomplete();
	}

	/**
   * Retrieve an <code>IProxy</code> from the <code>Model</code> by name.
   * 
   * @param proxyName the name of the proxy to be retrieved.
   * @return the <code>IProxy</code> instance previously registered with the given <code>proxyName</code>.
   */
	public function testRetrieveProxy()
	{
		$this->markTestIncomplete();
	}

	/**
   * Check to see if a Proxy is registered with the Model.
   * 
   * @param proxyName name of the <code>IProxy</code> instance to check for.
   */
	public function testHasProxy()
	{
		$this->markTestIncomplete();
	}

	/**
   * Remove an <code>IProxy</code> from the <code>Model</code> by name.
   *
   * @param proxyName the <code>IProxy</code> to remove from the <code>Model</code>.
   */
	public function testRemoveProxy()
	{
		$this->markTestIncomplete();
	}

	/**
   * Register a <code>IMediator</code> with the <code>View</code>.
   * 
   * @param mediatorName the name to associate with this <code>IMediator</code>
   * @param mediator a reference to the <code>IMediator</code>
   */
	public function testRegisterMediator()
	{
		$this->markTestIncomplete();
	}

	/**
   * Retrieve an <code>IMediator</code> from the <code>View</code>.
   * 
   * @param mediatorName
   * @return the <code>IMediator</code> previously registered with the given <code>mediatorName</code>.
   */
	public function testRetrieveMediator()
	{
		$this->markTestIncomplete();
	}

	/**
   * Check to see if a Mediator is registered with the View.
   * 
   * @param mediatorName name of the <code>IMediator</code> instance to check for.
   */
	public function testHasMediator()
	{
		$this->markTestIncomplete();
	}

	/**
   * Remove an <code>IMediator</code> from the <code>View</code>.
   * 
   * @param mediatorName name of the <code>IMediator</code> to be removed.
   */
	public function testRemoveMediator()
	{
		$this->markTestIncomplete();
	}

	/**
   * Send an <code>INotification</code>.
   * 
   * <P>
   * Keeps us from having to construct new notification 
   * instances in our implementation code.
   * @param notificationName the name of the notiification to send
   * @param body the body of the notification (optional)
   * @param type the type of the notification (optional)
   */
	public function testSendNotification()
	{
		$this->markTestIncomplete();
	}

	function tearDown()
	{
	}

}
