<?php
namespace Pure\Core;

use PHPUnit_Framework_TestCase;
use Pure\Core\DoctrineRun;

class DoctrineRunTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * 
	 * @return \Doctrine\ORM\EntityManager
	 */
	public function testGetEntityManager()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Genere les tables en BDD
	 * 
	 * @param string $drop_existing_tables
	 * @return boolean
	 */
	public function testGenerateTables()
	{
		$this->markTestIncomplete();
	}

	/**
	 * 
	 * @param unknown $path
	 */
	public function testGenerateEntities()
	{
		$this->markTestIncomplete();
	}

	/**
	 * 
	 * http://www.doctrine-project.org/jira/browse/DDC-1698
	 * https://github.com/doctrine/DoctrineBundle/blob/master/DoctrineBundle.php#L57
	 * 
	 * @param string $path - if null generate proxies to default path
	 */
	public function testGenerateProxies()
	{
		$this->markTestIncomplete();
	}

	/**
	 * 
	 * @return boolean
	 */
	public function testValidateSchemas()
	{
		$this->markTestIncomplete();
	}

	public function test_logErrors()
	{
		$this->markTestIncomplete();
	}

	function tearDown()
	{
	}

}
