<?php
namespace Bluemagic\Utils;

use PHPUnit_Framework_TestCase;
use Bluemagic\Utils\DatabaseUtils;

class DatabaseUtilsTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * Teste si l'extension PDO peut utiliser les drivers mysql
	 */
	public function testIsDriverAvailable()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Verifie une connection sur une BDD MySQL
	 * 
	 * @param string $host
	 * @param string $name
	 * @param string $user
	 * @param string $password
	 * 
	 * @return boolean
	 */
	public function testIsDatabaseAvailable()
	{
		$this->markTestIncomplete();
	}

	function tearDown()
	{
	}

}
