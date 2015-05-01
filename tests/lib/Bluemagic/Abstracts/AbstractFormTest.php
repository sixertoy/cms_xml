<?php
namespace Bluemagic\Abstracts;

use PHPUnit_Framework_TestCase;
use Bluemagic\Abstracts\AbstractForm;

class AbstractFormTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	public function testHasErrors()
	{
		$this->markTestIncomplete();
	}

	public function testBuild()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Verifie que les elements d'un formulaire soit valides
	 */
	public function testValidate()
	{
		$this->markTestIncomplete();
	}

	public function testAddError()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Fabrique des elements
	 * 
	 * @param		$pType string
	 * @param		$pLabel string - Label de l'input
	 * @return		AbstractInput
	 */
	public function testCreateElement()
	{
		$this->markTestIncomplete();
	}

	public function testHydrateWithJSon()
	{
		$this->markTestIncomplete();
	}

	/**
	 * @TODO iteration a travers les noeuds type #text pas terrible, faire mieux.
	 * 
	 * @param DomDocument $document
	 */
	public function testHydrateWithXML()
	{
		$this->markTestIncomplete();
	}

	public function testHydrateWithArray()
	{
		$this->markTestIncomplete();
	}

	public function testHydrateWithObject()
	{
		$this->markTestIncomplete();
	}

	public function testHydrateWithCookie()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Ajoute un element au formulaire
	 * 
	 * @param $pElement AbstractInput
	 * @return	 AbstractInput
	 */
	public function testAddElement()
	{
		$this->markTestIncomplete();
	}

	public function testHasElement()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne les elements
	 */
	public function testGetElementById()
	{
		$this->markTestIncomplete();
	}

	public function testGetElementsByType()
	{
		$this->markTestIncomplete();
	}

	public function testGetElements()
	{
		$this->markTestIncomplete();
	}

	public function testGetElement()
	{
		$this->markTestIncomplete();
	}

	public function testGetId()
	{
		$this->markTestIncomplete();
	}

	public function testSetId()
	{
		$this->markTestIncomplete();
	}

	public function testGetAction()
	{
		$this->markTestIncomplete();
	}

	public function testSetAction()
	{
		$this->markTestIncomplete();
	}

	public function testGetMethod()
	{
		$this->markTestIncomplete();
	}

	public function testSetMethod()
	{
		$this->markTestIncomplete();
	}

	public function testGetEnctype()
	{
		$this->markTestIncomplete();
	}

	public function testSetEnctype()
	{
		$this->markTestIncomplete();
	}

	function tearDown()
	{
	}

}
