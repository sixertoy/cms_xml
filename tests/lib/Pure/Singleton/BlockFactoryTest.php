<?php
namespace Pure\Singleton;

use PHPUnit_Framework_TestCase;
use Pure\Singleton\BlockFactory;

class BlockFactoryTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * Parse les noeuds enfants d'un block
	 * Cree les instances des blocks
	 * 
	 * @param Bluemagic\Abstracts\Blocks\AbstractBlock $pParent
	 */
	public function testParseBlockChilds()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Cree l'instance d'une classe 
	 * 
	 * @param string $class_name
	 * @param array $args
	 * @return object
	 */
	public function testNewInstance()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Execute une methode d'une classe cree dynamiquement
	 * 
	 * @param object $instance
	 * @param string $action
	 * @param array $args
	 * @return mixed
	 */
	public function testExecute()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Verifie si l'action est contenu dans la classe
	 * 
	 * @param string $class_name
	 * @param string $action
	 * @return boolean
	 */
	public function testHasMethod()
	{
		$this->markTestIncomplete();
	}

	function tearDown()
	{
	}

}
