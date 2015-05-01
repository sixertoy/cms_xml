<?php
namespace Pure\Core;

use PHPUnit_Framework_TestCase;
use Pure\Core\Layout;

class LayoutTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * Retourne le document XML du layout
	 */
	public function testGetDocument()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne le controller du layout
	 * Definie par l'attribut "default"
	 */
	public function testGetControllerPackage()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne l'action du layout
	 * Qui doit etre execute lors du premier chargement de la page en premier
	 */
	public function testGetDefaultController()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne l'action du layout
	 * Qui doit etre execute lors du premier chargement de la page en premier
	 */
	public function testGetDefaultAction()
	{
		$this->markTestIncomplete();
	}

	/**
	 * 
	 * @param unknown $node_name
	 * @return DOMNode|boolean
	 */
	public function testGetModuleNode()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Chargement du Layout XML
	 * Le layout s'occupe de definir les actions
	 * Et les changements/methodes a execute dans la vue 
	 * 
	 * @return		Bluemagic\Core\Objects\Layout
	 */
	public function testLoadLayoutFile()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Charge un DomNode dans layout courant
	 *  
	 * @param DOMElement $node
	 * @return \Pure\Core\Layout
	 */
	public function testLoadNode()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Mise a jour d'un layout par le noeud d'un autre
	 * 
	 * @param Bluemagic\Core\layout $updater_layout
	 * @param string $update_node_name
	 * @return boolean
	 */
	public function testUpdateLayout()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne un noeud par son ID
	 * @param string $blockId
	 */
	public function testGetBlockById()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne un noeud a une position courante dans le document
	 * @param string $nodepath
	 * @param int $index
	 * @return DOMNode
	 */
	public function testGetBlockAt()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne un noeud par son nom dans le document
	 * 
	 * @param string $name
	 * @return DOMNodeList
	 */
	public function testGetNodesByName()
	{
		$this->markTestIncomplete();
	}

	function tearDown()
	{
	}

}
