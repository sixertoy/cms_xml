<?php
namespace Bluemagic\Helpers;

use PHPUnit_Framework_TestCase;
use Bluemagic\Helpers\DomHelper;

class DomHelperTest extends PHPUnit_Framework_TestCase
{
	function setUp()
	{
	}

	/**
	 * Transforme un document XML en Array
	 * 
	 * @param DomDocument $document
	 * @return multitype:string
	 */
	public function testToArray()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne un element sur un arbre d'apres son ID
	 * 
	 * @param unknown $document
	 * @param unknown $id
	 */
	public function testGetElementById()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne la valeur de l'attribut "id" d'un noeud
	 * @param domnode $pNode
	 * @param string $pAttr
	 * 
	 * @return string
	 */
	public function testGetNodeAttr()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Enregistre une chaine XML dans un nouveau fichier
	 * @param string $string
	 */
	public function testSaveXML()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Charge un XML
	 * @param string $string
	 */
	public function testLoadXML()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Change le nom d'un noeud
	 * 
	 * @param domdocument $pDocument
	 * @param string $OldName
	 * @param string $pNewName
	 * 
	 * @return boolean
	 */
	public function testUpdateNodeName()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Insere un noeud dans un document existant
	 * 
	 * @param XMLNode $parent
	 * @param XMLNode $node
	 * @param string $deep
	 */
	public function testInsertNode()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Mise a jour de la valeur d'un attribut sur un noeud existant
	 * 
	 * @param unknown $node
	 * @param unknown $attr_name
	 * @param unknown $attr_value
	 */
	public function testUpdateAttrValue()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Insere un attribut pour un noeud existant 
	 * @param unknown $pNode
	 * @param unknown $pName
	 * @param unknown $pValue
	 */
	public function testInsertAttr()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Supprime un noeud de l'arbre XML
	 * @param unknown $pNode
	 */
	public function testRemoveNode()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Remplace un noeud dans l'arbre XML
	 * @param unknown $pOldNode
	 * @param unknown $pNewNode
	 */
	public function testReplaceNode()
	{
		$this->markTestIncomplete();
	}

	public function testCreateNewDocument()
	{
		$this->markTestIncomplete();
	}

	public function testCreateNewDocumentNS()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Retourne un nouveau DomDocument
	 * @return DomDocument
	 */
	public function testNewDomDocument()
	{
		$this->markTestIncomplete();
	}

	function tearDown()
	{
	}

}
