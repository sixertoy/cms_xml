<?php
namespace Pure\Core;

use PHPUnit_Framework_TestCase;
use Pure\Core\Root;

class RootTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * Ajoute les classes sur le body
	 * 
	 * Les classe indiquant de layout
	 * Les classe indiquant la vue+l'action
	 */
	public function testAddDocumentClasses()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Function appelle depuis le Layout XML
	 * 
	 * @param string $classes_string
	 */
	public function testSetBodyClass()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Function appelle depuis le template PHTML
	 * 
	 * @return string
	 */
	public function testGetBodyClass()
	{
		$this->markTestIncomplete();
	}

	public function test__toString()
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

	public function testUseTemplate()
	{
		$this->markTestIncomplete();
	}

	public function testGetDebuggable()
	{
		$this->markTestIncomplete();
	}

	public function testSetDebuggable()
	{
		$this->markTestIncomplete();
	}

	public function testGetTemplate()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Affecte un template au block
	 * Le template peut etre setter a false dans le XML
	 * 
	 * @param string $value
	 */
	public function testSetTemplate()
	{
		$this->markTestIncomplete();
	}

	public function testGetType()
	{
		$this->markTestIncomplete();
	}

	public function testSetType()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Si la classe etend la classe de responder AJAX
	 * 
	 */
	public function testIsAsynchronous()
	{
		$this->markTestIncomplete();
	}

	public function testGetParent()
	{
		$this->markTestIncomplete();
	}

	public function testGetChilds()
	{
		$this->markTestIncomplete();
	}

	public function testGetChildById()
	{
		$this->markTestIncomplete();
	}

	public function testGetChildNodes()
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

	/**
	 *  Les methodes passees call dans le XML
	 *  Seront appellees sur le render de la vue
	 *  Apres l'initialization de l'ApplicationMediator
	 *  
	 * @param unknown $commands
	 */
	public function testAddCallMethods()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Parcours les objets enfants
	 * Initialize les classes de Blocks
	 * 
	 * Si la classe n'est pas definit
	 * On utilise la classe Bluemagic\Abstracts\Blocks\AbstractBlocks
	 * 
	 * @TODO Ajoute l'id du parent a l'id de l'enfant
	 * 
	 * @param DOMNodeList $pChilds
	 * @return Pure\Abstracts\AbstractBlock
	 */
	public function testParseChilds()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Lance le rendu d'un enfant du block
	 * Depuis la vue HTML
	 * 
	 * @param string $id
	 * @return boolean
	 */
	public function testGetChildHtml()
	{
		$this->markTestIncomplete();
	}

	public function testRender()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Renvoi sur le parent les methodes
	 * Non definies sur le block
	 * 
	 * Les methodes remontent jusqu'a l'ApplicationMediator
	 * Parent du block Root
	 * 
	 * Les methodes anonymes en get sont autorisees
	 * Les methodes anonymes en set ne sont pas autorisees
	 * 
	 * @see \Bluemagic\Core\Object::__call()
	 */
	public function test__call()
	{
		$this->markTestIncomplete();
	}

	function tearDown()
	{
	}

}
