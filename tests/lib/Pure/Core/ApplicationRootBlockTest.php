<?php
namespace Pure\Core;

use PHPUnit_Framework_TestCase;
use Pure\Core\ApplicationRootBlock;

class ApplicationRootBlockTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * (non-PHPdoc)
	 * @see \Pure\Abstracts\AbstractBlock::setTemplate()
	 */
	public function testSetTemplate()
	{
		$this->markTestIncomplete();
	}

	/**
	 * 
	 * @param unknown $parent
	 * @return \Pure\Core\ApplicationView
	 */
	public function testSetParent()
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

	/**
	 * Ajoute des classes CSS au Body HTML
	 * 
	 * @param string $classes_string
	 */
	public function test_addBodyClass()
	{
		$this->markTestIncomplete();
	}

	/**
	 * 
	 * @return string
	 */
	public function test__toString()
	{
		$this->markTestIncomplete();
	}

	/**
	 * 
	 * @return string
	 */
	public function testGetId()
	{
		$this->markTestIncomplete();
	}

	/**
	 * 
	 * @param string $pValue
	 * @return \Pure\Abstracts\AbstractBlock
	 */
	public function testSetId()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Determine si le block beneficie du layout hover debug
	 * @return boolean
	 */
	public function testGetDebuggable()
	{
		$this->markTestIncomplete();
	}

	/**
	 * 
	 * @param string $pValue
	 * @return \Pure\Abstracts\AbstractBlock
	 */
	public function testSetDebuggable()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne le template pour le block en cours
	 * @return string
	 */
	public function testGetTemplate()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne le type/class pour le block en cours
	 * @return string
	 */
	public function testGetType()
	{
		$this->markTestIncomplete();
	}

	/**
	 * 
	 * @param string $pValue
	 * @return \Pure\Abstracts\AbstractBlock
	 */
	public function testSetType()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Si la classe etend la classe de responder AJAX
	 * @return boolean
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

	/**
     * Retourne le nom de la classe de l'objet
     * @return string
     */
	public function testGetClassName()
	{
		$this->markTestIncomplete();
	}

	/**
     * 
     * @return string
     */
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
