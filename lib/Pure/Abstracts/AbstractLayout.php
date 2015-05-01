<?php
namespace Pure\Abstracts;

use DOMXpath;
use DomDocument;

use Bluemagic\Core\Debug;
use Bluemagic\Helpers\DomHelper;
use Bluemagic\Core\CoreConstants;

class AbstractLayout
{
	private $_file;
	private $_name;
	private $_xpath;
	private $_document;
	private $_xpathPrefix;
	private $_rootDocument;
	private $_namespaceURI;
	
	static private $_modifiers_node_names = array( "replace", "update", "remove" );

	const ROOT_NODE_ID = "root";
	const VIEW_NODE_NAME = "view";
	const XPATH_QUERY_PREFIX = "//";
	const BLOCK_NODE_NAME = "block";
	const ROOT_NODE_NAME = "layout";
	const UPDATE_NODE_NAME = "update";
	const REMOVE_NODE_NAME = "remove";
	const REPLACE_NODE_NAME = "replace";
	const DEFAULT_NODE_NAME = "default";
	
	const ACTION_ATTR_NAME = "action";
	const PACKAGE_ATTR_NAME = "package";
	const CONTROLLER_ATTR_NAME = "controller";
	
	/**
	 * @param string $name Nom du layout
	 */
	function __construct( $name )
	{
		$this->_name = $name;
		// Definie le prefix de l'index XPath
		$this->_xpathPrefix = self::XPATH_QUERY_PREFIX;
	}
	
	/**
	 * Retourne le document XML du layout
	 */
	public function getDocument()
	{
		return $this->_rootDocument;
	}
	
	/**
	 * Retourne le controller du layout
	 * Definie par l'attribut "default"
	 */
	public function getControllerPackage()
	{
		$node = $this->getNodesByName( self::DEFAULT_NODE_NAME )->item( 0 );
		$controller = DomHelper::getNodeAttr( $node, self::PACKAGE_ATTR_NAME );
		if( $controller ) return $controller;
		return false;
	}
	
	/**
	 * Retourne l'action du layout
	 * Qui doit etre execute lors du premier chargement de la page en premier
	 */
	public function getDefaultController()
	{
		$node = $this->getNodesByName( self::DEFAULT_NODE_NAME )->item( 0 );
		$value = DomHelper::getNodeAttr( $node, self::CONTROLLER_ATTR_NAME );
		if( $value ) return $value;
		return false;
	}
	
	/**
	 * Retourne l'action du layout
	 * Qui doit etre execute lors du premier chargement de la page en premier
	 */
	public function getDefaultAction()
	{
		$node = $this->getNodesByName( self::DEFAULT_NODE_NAME )->item( 0 );
		$value = DomHelper::getNodeAttr( $node, self::ACTION_ATTR_NAME );
		if( $value ) return $value;
		return false;
	}
	
	/**
	 * 
	 * @param unknown $node_name
	 * @return DOMNode|boolean
	 */
	public function getModuleNode( $node_name )
	{
		$node = $this->getNodesByName( $node_name )->item( 0 );
		if( $node ) return $node;
		return false;
	}
	
	/**
	 * Chargement du Layout XML
	 * Le layout s'occupe de definir les actions
	 * Et les changements/methodes a execute dans la vue 
	 * 
	 * @return		Bluemagic\Core\Objects\Layout
	 */
	public function loadLayoutFile( $file )
	{
		$this->_file = $file;
		$this->_rootDocument = new DomDocument( "1.0", "utf-8" );
		$loaded = @$this->getDocument()->load( $this->_file );
		$this->getDocument()->formatOutput = true;
		if( $loaded )
		{
			$this->_initXPath();
			return $this;
		}
		else
		{
			$message = "Impossible de charger le fichier de layout $file";
			Debug::trace( $message, Debug::DEBUG );
			return false;
		}
	}
	/**
	 * Charge un DomNode dans layout courant
	 *  
	 * @param DOMElement $node
	 * @return \Pure\Core\Layout
	 */
	public function loadNode( $node )
	{
		if( $node->nodeType !== XML_ELEMENT_NODE )
		{
			$message = "Impossible de charger le noeud dans le layout '$this->_name'. Le noeud n'est pas de type XML_ELEMENT_NODE";
			Debug::trace( $message, Debug::FATAL );
			return false;
		}
		$this->_rootDocument = DomHelper::createNewDocument( self::ROOT_NODE_NAME );
		$parent = $this->getDocument()->documentElement;
		DomHelper::insertNode( $parent, $node, true );
		$this->_initXPath();
		$this->getDocument()->formatOutput = true;
		return $this;
	}
	
	/**
	 * Mise a jour d'un layout par le noeud d'un autre
	 * 
	 * @param Bluemagic\Core\layout $updater_layout
	 * @param string $update_node_name
	 * @return boolean
	 */
	public function updateLayoutWithView( $updater_layout, $view_node_name )
	{
		$view = $updater_layout->getViewByName( $view_node_name );
		if( !$view )
		{
			$message = "La vue '$view_node_name' n'a pas ete importe sur le layout $this->_name";
			Debug::trace( $message, Debug::ERROR );
			return false;	
		}
		return $this->_importLayoutNode( $view );
	}

	/**
	 * Mise a jour d'un layout par le noeud d'un autre
	 *
	 * @param Bluemagic\Core\layout $updater_layout
	 * @param string $update_node_name
	 * @return boolean
	 */
	public function updateLayout( $updater_layout, $update_node_name )
	{
		$node = $updater_layout->getNodesByName( $update_node_name )->item( 0 );
		if( !$node )
		{
			$message = "Le noeud '$update_node_name' n'a pas ete importe sur le layout $this->_name";
			Debug::trace( $message, Debug::ERROR );
			return false;
		}
		return $this->_importLayoutNode( $node );
	}
	
	/**
	 * 
	 * @param unknown $node
	 * @return boolean
	 */
	private function _importLayoutNode( $node )
	{
		$temp_layout = new AbstractLayout( "temp_layout" );
		$temp_layout->loadNode( $node );
		$this->_updateLayout( $temp_layout );
		unset( $temp_layout );
		$this->getDocument()->formatOuput = true;
		return true;	
	}

	/**
	 * Mise a jour d'un layout
	 * 
	 * @param unknown $updater
	 * @return \Pure\Core\Layout
	 */
	private function _updateLayout( $updater )
	{
		foreach( self::$_modifiers_node_names as $key )
		{
			$nodes = $updater->getNodesByName( $key );
			foreach( $nodes as $update_node )
			{
				$id = DomHelper::getNodeAttr( $update_node, "id" ); //Recupere l'id du noeud de modification
				switch( $key )
				{
					case self::REMOVE_NODE_NAME:
						$this->_removeNode( $id );
						break;
					case self::REPLACE_NODE_NAME:
						$this->_replaceNode( $id, $update_node );
						break;
					case self::UPDATE_NODE_NAME:
						$this->_updateNode( $id, $update_node );
						break;
				}
			}
		}
		return $this;
	}
	
	/**
	 * Retourne les attributs d'un block
	 *
	 * @param DomNode $block_node
	 */
	private function _getAttributesOn( $block_node )
	{
	    // Seuls les attributs template et type sont autorisés
	    $restricted_properties = array( "type", "template", "debuggable" );
	    // Si d'autres attributs autres que 'id' sont settes
		if( $block_node->attributes->length > 1 )
		{
		    $result = array();
            foreach( $block_node->attributes as $attr_node )
            {
                $node_name = $attr_node->nodeName;
                if( $node_name == "id" ) continue;
                if( !in_array( $node_name, $restricted_properties ) ) continue;
                
                $value = trim( $attr_node->nodeValue );
                if( !empty( $value ) ) $result[ $node_name ] = $value;
            }
            if( !empty( $result ) ) return $result;
		}
		return false;
	}


	/**
	 * Retourne un noeud par son ID
	 * @param string $name
	 * @return \DOMNode
	 */
	public function getViewByName( $name )
	{
		$query = self::VIEW_NODE_NAME.'/@name[.="'.$name.'"]';
		$query = $this->_getPrefixedQuery( $query );
		$view = $this->_xpath->query( $query );
		if( $view->length < 1 )
		{
			$message =  "Aucune vue pour l'identifiant ".$name." n'a ete trouve";
			Debug::trace( $message, Debug::ERROR );
			return false;
		}
		else if( $view->length > 1 )
		{
			$message = "L'identifiant ".$name." d'une vuew doit etre unique";
			Debug::trace( $message, Debug::ERROR );
			return false;
		}
		else return $view->item( 0 )->parentNode;
	}
	
	/**
	 * Retourne un noeud par son ID
	 * @param string $id
	 * @return \DOMNode
	 */
	public function getBlockById( $id )
	{
		$query = self::BLOCK_NODE_NAME.'/@id[.="'.$id.'"]';
		$query = $this->_getPrefixedQuery( $query );
		$node = $this->_xpath->query( $query );
		if( $node->length < 1 )
		{
			$message =  "Aucun noeud pour l'identifiant ".$id." n'a ete trouve";
			Debug::trace( $message, Debug::ERROR );
			return false;
		}
		else if( $node->length > 1 )
		{
			$message = "L'identifiant ".$id." d'un noeud doit etre unique";
			Debug::trace( $message, Debug::ERROR );
			return false;
		}
		else return $node->item( 0 )->parentNode;
	}
	
	/**
	 * Retourne un noeud a une position courante dans le document
	 * @param string $nodepath
	 * @param int $index
	 * @return \DOMNode
	 */
	public function getBlockAt( $nodepath, $index )
	{
		$nodes = $this->_xpath->query( $nodepath );
		$node->item( $index );
		return $node;
	}
	
	/**
	 * Retourne un noeud par son nom dans le document
	 * 
	 * @param string $name
	 * @return DOMNodeList
	 */
	public function getNodesByName( $name )
	{
		$query = $this->_getPrefixedQuery( $name );
		$nodes = $this->_xpath->query( $query );
		return $nodes;
	}
	
	/**
	 * Mise a jour d'un noeud
	 * 
	 * @param string $id
	 * @param DOMElement $update_node
	 * @return boolean
	 */
	private function _updateNode( $id, $update_node )
	{
		$modifiers = self::$_modifiers_node_names;
		$block = $this->getBlockById( $id ); // Recupere le noeud a modifier
		// Si le noeud n'existe pas
		if( !$block )
		{
			$message = "Erreur lors de l'update du noeud '$id'=> le noeud n'existe pas";
			Debug::trace( $message, Debug::ERROR );
			return false;
		}
		// Uniquement valable pour le noeud de type 'update'
		// Puisqu'on teste sur un nombre sup de attr
		// Considerant que le nombre minimun correspond a 1
		// Attribut 'id' minimum
		$update_attributes = $this->_getAttributesOn( $update_node );
		if( !empty( $update_attributes ) )
		{
		    foreach( $update_attributes as $attr_name=>$attr_value )
		    {
		        $block->setAttribute( $attr_name, $attr_value );
		    }
		}
		// Si le noeud existe et a des enfants
		if( $update_node->hasChildNodes() )
		{
		    // On recupere les noeuds enfants
			$childs = $update_node->childNodes;
			foreach( $childs as $child )
			{
				if
				( ( $child->nodeType == XML_TEXT_NODE )
					|| ( in_array( $child->nodeName, $modifiers ) )
					|| ( $child->nodeType == XML_COMMENT_NODE )
				) continue;
				// On inclus tous les enfants dans le layout a modifier
				DomHelper::insertNode( $block, $child );
			}
		}
		return true;
	}

	/**
	 * Suppression + Replacement d'un noeud
	 * 
	 * @param string $id
	 * @param DOMElement $update_node
	 * @return boolean
	 */
	private function _replaceNode( $id, $update_node )
	{
		$block = $this->getBlockById( $id ); // Recupere le noeud a modifier
		if( !$block )
		{
			$message = "Erreur lors de la modification du noeud '$id'=> le noeud n'existe pas";
			Debug::trace( $message, Debug::ERROR );
			return false;
		}
		$parent = $block->parentNode;
		DomHelper::removeNode( $block );
		$new_node = DomHelper::insertNode( $parent, $update_node );
		DomHelper::updateNodeName( $new_node, self::BLOCK_NODE_NAME );
		return true;
	}
	
	/**
	 * Supprime un noeud par son 'id' dans le layout courant
	 * 
	 * @param string $id
	 * @return boolean
	 */
	private function _removeNode( $id )
	{
		$node = $this->getBlockById( $id ); // Recupere le noeud a modifier
		if( !$node )
		{
			$message = "Erreur lors de la suppression du noeud '$id'=> le noeud n'existe pas";
			Debug::trace( $message, Debug::WARN );
			return false;
		}
		DomHelper::removeNode( $node );
		return true;
	}
	
	/**
	 * Retourne la requete xpath
	 * 
	 * @param string $query
	 * @return string
	 */
	private function _getPrefixedQuery( $query )
	{
		if( !is_null( $this->_namespaceURI ) ) return ( self::XPATH_QUERY_PREFIX.$this->_xpathPrefix.":".$query );
		else return ( self::XPATH_QUERY_PREFIX.$query );
	}
	
	/**
	 * Initialize les requetes xpath pour le document en cours
	 */
	private function _initXPath()
	{
		$this->_namespaceURI = $this->_rootDocument->documentElement->lookupnamespaceURI( null );
		$this->_xpath = new DOMXPath( $this->_rootDocument );
		if( !is_null( $this->_namespaceURI ) ) $this->_xpath->registerNamespace( $this->_xpathPrefix, $this->_namespaceURI );		
	}
	
}
