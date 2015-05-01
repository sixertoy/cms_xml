<?php
namespace Pure\Patterns\Commands;

use PHPUnit_Framework_TestCase;
use Pure\Patterns\Commands\PrepareApplicationCommand;

class PrepareApplicationCommandTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * Si ce n'est pas une vue d'erreur
	 * Teste si le fichier encrypte des donnes de BDD existe
	 * Et que l'URL n'est pas correcte
	 * Redirige vers la vue de base
	 * Si l'application n'est pas prete et que ce n'est pas la vue d'installation
	 * 
	 * @see \PureMVC\Patterns\Command\SimpleCommand::execute()
	 */
	public function testExecute()
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
