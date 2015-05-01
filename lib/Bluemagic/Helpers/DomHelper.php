<?php

namespace Bluemagic\Helpers;

use Bluemagic\Utils\StringUtils;

use DOMXPath;
use DomDocument;

use Bluemagic\Core\Debug;
use Bluemagic\Utils\FileUtils;

class DomHelper
{
	
	/**
	 * Transforme un document XML en Array
	 * 
	 * @param DomDocument $document
	 * @return multitype:string
	 */
	static public function toArray( $document )
	{
		$result = array();
		$root_node = $document->firstChild;
		foreach( $root_node->childNodes as $node )
		{
			$id = DomHelper::getNodeAttr( $node, "id" );
			if( $id ) $result[ $id ] = trim( $node->nodeValue );
		}
		return $result;
	}
	
	/**
	 * Retourne un element sur un arbre d'apres son ID
	 * 
	 * @param unknown $document
	 * @param unknown $id
	 */
	static public function getElementById( $document, $id )
	{
    	 $xpath = new DOMXPath( $document );
    	 $node = $xpath->query( "//*[@id='$id']" )->item( 0 );
    	 if( is_null( $node ) || empty( $node ) ) return false;
     	return $node;
	}
	
	/**
	 * Retourne la valeur de l'attribut "id" d'un noeud
	 * @param domnode $pNode
	 * @param string $pAttr
	 * 
	 * @return string
	 */
	static public function getNodeAttr( $node, $attr )
	{
		$type = $node->nodeType;
		if( $type == XML_TEXT_NODE ) return false;
		if( $type == XML_COMMENT_NODE ) return false;
		$value = @$node->getAttribute( $attr ); 
		if( is_null( $value ) || empty( $value ) ) return false;
		return $value;
	}
	
	/**
	 * Enregistre une chaine XML dans un nouveau fichier
	 * @param string $string
	 */
	static public function saveXML( $string, $filename, $is_secured=false )
	{
		$document = self::newDomDocument();
		$document->loadXML( $string );
		$folder = FileUtils::getFileBase( $filename );
		FileUtils::createFolder( $folder );
		$saved = $document->save( $filename );
		if( $is_secured )
		{
			// @TODO Securisation des fichiers en ajoutant l'extension .php
		}
		return $saved; 
	}
	
	/**
	 * Charge un XML
	 * @param string $string
	 */
	static public function loadXML( $filename, $is_secured=false )
	{
		if( $is_secured )
		{
			// @TODO Securisation des fichiers en ajoutant l'extension .php
		}
		else
		{
			$document = self::newDomDocument();
			$loaded = @$document->load( $filename );
			if( !$loaded )
			{
				$message = "Impossible de charger le XML '$filename'.";
				Debug::trace( $message, Debug::ERROR );
				return false;
			}
			return $document;
		}
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
	static public function updateNodeName( $old_node, $new_Name )
	{
		$document = $old_node->ownerDocument;
		$new_node = $document->createElement( $new_Name );
		$attributes = $old_node->attributes;
		foreach( $attributes as $attribute ) $new_node->setAttribute( $attribute->name, $attribute->value );
		if( $old_node->hasChildNodes() )
		{
			$children = $old_node->childNodes;
			foreach( $children as $child )
			{
				$new_child = $child->cloneNode( true );
				$new_node->appendChild( $new_child );
			}
		}
		$old_node->parentNode->appendChild( $new_node );
		$old_node->parentNode->removeChild( $old_node );
		$document->formatOuput = true;
		return true;	
	}
	
	/**
	 * Insere un noeud dans un document existant
	 * 
	 * @param XMLNode $parent
	 * @param XMLNode $node
	 * @param string $deep
	 */
	static public function insertNode( $parent, $node, $deep=true )
	{
		$clone = $parent->ownerDocument->importNode( $node, $deep );
		return $parent->appendChild( $clone );
	}
	
	/**
	 * Mise a jour de la valeur d'un attribut sur un noeud existant
	 * 
	 * @param unknown $node
	 * @param unknown $attr_name
	 * @param unknown $attr_value
	 */
	static public function updateAttrValue( $node, $attr_name, $attr_value )
	{
	    $node->setAttribute( $attr_name, $attr_value );
	    return true;
	}
	
	/**
	 * Insere un attribut pour un noeud existant 
	 * @param unknown $pNode
	 * @param unknown $pName
	 * @param unknown $pValue
	 */
	static public function insertAttr( $node, $key, $value )
	{
		$attr = $node->ownerDocument->createAttribute( $key );
		$value = $node->ownerDocument->createTextNode( $value );
		$attr->appendChild( $value );
		return $node->appendChild( $attr );
	}
	
	/**
	 * Supprime un noeud de l'arbre XML
	 * @param unknown $pNode
	 */
	static public function removeNode( $node )
	{
		$node->parentNode->removeChild( $node );
		return true;
	}
	
	/**
	 * Remplace un noeud dans l'arbre XML
	 * @param unknown $pOldNode
	 * @param unknown $pNewNode
	 */
	static public function replaceNode( $oldNode, $newNode )
	{
		$oldNode->parentNode->replaceNode( $oldNode, $newNode );
		return true;
	}
	
	static public function createNewDocument( $name )
	{
		$document = self::newDomDocument();
		$root = $document->createElement( $name );
		$document->appendChild( $root );
		return $document;
	}
	
	static public function createNewDocumentNS( $name, $NS )
	{
		$document = self::newDomDocument();
		$root = $document->createElementNS( $NS, $name );
		$document->appendChild( $root );
		return $document;
	}
	
	/**
	 * Retourne un nouveau DomDocument
	 * @return DomDocument
	 */
	static public function newDomDocument()
	{
		$document = new DomDocument( "1.0", "utf-8" );
		$document->formatOutput = true;
		$document->validateOnParse = true;
		$document->preserveWhiteSpace = false;
		return $document;
	}
	
}