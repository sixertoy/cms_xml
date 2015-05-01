<?php
namespace Bluemagic\Core;

use PHPUnit_Framework_TestCase;
use Bluemagic\Core\Object;

class ObjectTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
     * Methode magique PHP
     * Transforme un appel de methode en proprietes d'objet
     * 
     * @param unknown $pMethod
     * @param unknown $pArgs
     * @return Ambigous <NULL, multitype:>|multitype:
     */
	public function test__call()
	{
		$this->markTestIncomplete();
	}

	public function test__get()
	{
		$this->markTestIncomplete();
	}

	public function test__set()
	{
		$this->markTestIncomplete();
	}

	public function testHasMethod()
	{
		$this->markTestIncomplete();
	}

	public function testHasProperty()
	{
		$this->markTestIncomplete();
	}

	public function testSetData()
	{
		$this->markTestIncomplete();
	}

	public function testGetData()
	{
		$this->markTestIncomplete();
	}

	/**
     * Retourne les valeurs sous forme de XML string
     * 
     * @return string
     */
	public function testToXML()
	{
		$this->markTestIncomplete();
	}

	/**
     * Transforme l'objet JSON en Bluemagic\Core\Object 
     * @param string $json_string
     * @return Bluemagic\Core\Object
     */
	public function testJsonToObject()
	{
		$this->markTestIncomplete();
	}

	public function testToSerialized()
	{
		$this->markTestIncomplete();
	}

	public function testToJson()
	{
		$this->markTestIncomplete();
	}

	public function testToArray()
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

	function tearDown()
	{
	}

}
